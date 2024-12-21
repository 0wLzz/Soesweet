<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $admin = Auth::guard('admin')->user();

        if($admin){
            $products = Product::all();
            $categories = Category::all();
            return view('admin.menu.table', compact(['products', 'categories', 'admin']));
        }

        return redirect()->route('login');
    }

    public function create() {
        $admin = Auth::guard('admin')->user();

        if($admin){
            $categories = Category::all();
            return view('admin.menu.add', compact('categories', 'admin'));
        }

        return redirect()->route('login');
    }

    public function store(Request $request) {

        $request->validate([
            'name' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'description' =>  'required'
        ],
        [
            'name.required' => 'Harap Nama diisi',
            'image.required' => 'Gambar Harap diisi',
            'image.mimes' => 'Extension Gambar Harap png, jpg, jpeg',
            'price.required' => 'Harga Harap diisi',
            'price.integer' => 'Harga merupakan angka',
            'description.required' => 'Deskripsi Harap Diisi'
        ]);

        $image = $request->file('image');
        $imgName = time() . "_" . $image->getClientOriginalName();
        $image->move(public_path("img"), $imgName);

        Product::create([
            "category_id" =>$request->input('category_id'),
            "image" => $imgName,
            "name" =>$request->input('name'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            "description" =>$request->input('description'),
        ]);

        return redirect()->route('admin_table')->with('success', 'Data telah berhasil disimpan!');
    }

    public function delete(Product $product) {
        $count = Product::count();

        if($count <= 4) {
            return redirect()->route('admin_table')->with('success', 'Data gagal dihapus! Tidak boleh kurang dari 4 data!');
        }

        $oldImage = public_path('img/' . $product->image);
        unlink($oldImage);

        $product->delete();
        return redirect()->route('admin_table')->with('success', 'Data telah berhasil dihapus!');
    }

    public function edit(Product $product) {
        $admin = Auth::guard('admin')->user();

        if($admin){
            $categories = Category::all();
            return view('admin.menu.edit', compact('categories', 'admin', 'product'));
        }

        return redirect()->route('login');
    }

    public function update(Request $request, Product $product) {

        $request->validate([
            'name' => 'required',
            'image' => 'mimes:png,jpg,jpeg',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'description' =>  'required'
        ],
        [
            'name.required' => 'Harap Nama diisi',
            'image.mimes' => 'Extension Gambar Harap png, jpg, jpeg',
            'price.required' => 'Harga Harap diisi',
            'price.integer' => 'Harga merupakan angka',
            'description.required' => 'Deskripsi Harap Diisi'
        ]);

        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $imgName = time() . "_" . $image->getClientOriginalName();
            $image->move(public_path("img"), $imgName);

            $oldImage = public_path('img/' . $product->image);
            unlink($oldImage);
        }
        else {
            $imgName = $product->image;
        }

        $product->update([
            "image" => $imgName,
            "category_id" =>$request->input('category_id'),
            "name" =>$request->input('name'),
            "stock" =>$request->input('stock'),
            "description" =>$request->input('description'),
            "price" =>$request->input('price'),
        ]);

        $product->save();
        return redirect()->route('admin_table')->with('success', 'Data telah berhasil diperbarui!');
    }

    public function category (Category $category) {
        $admin = Auth::guard('admin')->user();

        if($admin){
            $search = $category->name;
            $products = Product::whereHas('category', function($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%");
            })->get();

            $categories = Category::all();
            return view('admin.menu.table', compact('product', 'categories', 'admin'));
        }

        return redirect()->route('login');
    }

    public function search(Request $request) {
        $admin = Auth::guard('admin')->user();

        if($admin){
            $categories = Category::all();
            $search = $request->input('search');

            $products = Product::where(function($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%");
            })->get();

            return view('admin.menu.table', compact('products','categories', 'admin'));
        }

        return redirect()->route('login');
    }
}
