<?php

namespace App\Http\Controllers;

use App\Models\InvoiceDetail;
use Illuminate\Pagination\Paginator;
use App\Models\InvoiceHeader;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class SalesController extends Controller
{
    public function index(){

        $admin = Auth::guard('admin')->user();

        if($admin){
            // Total sales by month
            $salesByMonth = InvoiceHeader::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, SUM(total_price) as total_sales")
                ->groupBy(InvoiceHeader::raw("DATE_FORMAT(created_at, '%Y-%m')"))
                ->orderBy('month', 'asc')
                ->get();

            $salesByYear = InvoiceHeader::selectRaw("YEAR(created_at) as year, SUM(total_price  ) as total_sales")
                ->groupBy(InvoiceHeader::raw("YEAR(created_at)"))
                ->orderBy('year', 'asc')
                ->get();

            $bestSellers = InvoiceDetail::selectRaw("SUM(quantity) AS total_sold, product_id")
            ->with(['product.category'])
            ->groupBy("product_id")
            ->orderBy('total_sold', 'desc')
            ->get();

            $userPurchases = InvoiceHeader::with('user', 'admin')->get();
            $invoices = InvoiceDetail::with('product', 'invoiceHeader.admin', 'invoiceHeader.user')
            ->get()
            ->groupBy('invoice_header_id');

            return view('admin.sales.sales', compact(['salesByMonth', 'salesByYear', 'bestSellers', 'userPurchases', 'invoices', 'admin']));
        }

        return redirect()->route('login');

    }

    public function update_status(Request $request, InvoiceHeader $invoiceHeader){

        if($request->status === 'Cancel'){
            // Asumsikan $invoiceHeader adalah objek InvoiceHeader
            $user = User::find($invoiceHeader->user_id);
            $user->update([
               'money' => $user->money += $invoiceHeader->total_price
            ]);
            $user->save();
        }

        $invoiceHeader->update([
            'status' => $request->status,
            'cancel' => $request->reason_cancel,
            'admin_id' => $request->admin_id
        ]);
        $invoiceHeader->save();

        return back()->with('success', 'Invoice status updated successfully!');
    }

}
