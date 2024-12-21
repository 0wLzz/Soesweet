<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\InvoiceHeader;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function order(Request $request, Product $product) {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $total = $cart[$product->id]['quantity'] + $request->input('quantity');

            if($total > $product->stock){
                return redirect()->route('login')->with('status', "Maaf namun stock tidak mencukupi");
            }
            $cart[$product->id]["quantity"] = $total;
        }
        else {

            if($request->input('quantity') > $product->stock){
                return redirect()->route('login')->with('status', "Maaf namun stock tidak mencukupi");
            }

            $cart[$product->id] = [
                "id" => $product->id,
                "name" => $product->name,
                "image" => $product->image,
                "category" => $product->category->name,
                "price" => $product->price,
                "quantity" => $request->input('quantity')
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('login')->with('status', 'Added to Cart!');
    }

    public function buy(Product $product) {
        $user = Auth::user();

        if (empty($user->money) || $product->price > $user->money) {
            return redirect()->back()->with('status', 'Not enough Money!');
        }

        $uniqueInvoiceId = sprintf('%08d', random_int(1000000, 9999999));
        $user->money -= $product->price;
        $user->save();

        $invoice = InvoiceHeader::create([
            "id" => $uniqueInvoiceId,
            "user_id" => $user->id,
            "admin_id" => 1,
            "total_price" => $product->price,
            'status' => 'Proses'
        ]);

        InvoiceDetail::create([
            "invoice_header_id" => $invoice->id,
            "product_id" => $product->id,
            "quantity" => 1
        ]);

        $product->stock -= 1;
        $product->save();

        return redirect()->route('login')->with('status', 'Successful!');
    }

    public function category (Category $category) {
        $user = Auth::user();
        $categories = Category::all();
        $newestToys = Product::orderBy('created_at', 'desc')->take(6)->get();
        $cart = session()->get('cart', []);
        $invoices = InvoiceHeader::with('invoiceDetails.product')->where('user_id', $user->id)->get();

        $search = $category->name;
        $toys = Product::whereHas('category', function($query) use ($search) {
            $query->where('name', 'LIKE', "%$search%");
        })->get();

        return view('index', compact('toys', 'categories', 'newestToys', 'cart', 'invoices'));
    }

    public function checkout($total)
    {
        $user = Auth::user();
        $cart = session()->get('cart', []);

        if ($total > $user->money) {
            return redirect()->route('login')->with('status', 'Not enough Money!');
        }

        $uniqueInvoiceId = sprintf('%08d', random_int(10000000, 99999999));

        $user->money -= $total;
        $user->save();

        $invoice = InvoiceHeader::create([
            "id" => $uniqueInvoiceId,
            "user_id" => $user->id,
            "admin_id" => 1,
            "total_price" => $total,
            'status' => 'Sedang Dimasak'
        ]);

        foreach ($cart as $item) {
            InvoiceDetail::create([
                "invoice_header_id" => $invoice->id,
                "product_id" => $item["id"],
                "quantity" => $item['quantity'],
                "subTotal" => $item["quantity"] * $item["price"]
            ]);

            $product = Product::find($item["id"]);
            if ($product) {
                $product->stock -= $item['quantity'];
                $product->save();
            }
        }

        session()->forget("cart");
        return redirect()->back()->with('status', 'Successful!');
    }

    public function delete_from_cart($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('status', 'Item removed from cart');
    }

}
