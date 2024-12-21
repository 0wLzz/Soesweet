<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\InvoiceHeader;
use App\Models\Testimony;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function index() {
        $user = Auth::user();
        $cart = session()->get('cart', []);
        $testimonies = Testimony::all();


        if($user) {
            $invoices = InvoiceHeader::with('invoiceDetails.product')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'asc')
            ->get();

            return view('Soesweet.Home', compact('cart', 'invoices', 'testimonies'));

        }

        return view('Soesweet.Home', compact('cart', 'testimonies'));
    }

    public function productPage(){
        $user = Auth::user();
        $cart = session()->get('cart', []);

        $categories = Category::all();
        $products = $categories->map(function ($category) {
            return (object)[
                'category' => $category,
                'products' => $category->products,
            ];
        });

        if($user) {
            $invoices = InvoiceHeader::with('invoiceDetails.product')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'asc')
            ->get();
            return view('Soesweet.ProductPage', compact ('products', 'categories', 'cart', 'invoices'));
        }

        return view('Soesweet.ProductPage', compact('products', 'categories', 'cart'));
    }

    public function userLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|email',
            'password' => 'required'
        ], [
            'username.required' => 'Email harap diisi',
            'username.email' => 'Harap diisi email yang valid',
            'password.required' => 'Password harap diisi',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator, 'login')
                            ->withInput()
                            ->with('status', 'Invalid Credentials!');
        }

        // Check in Admin table first
        $admin = Admin::where('email', $request->input('username'))->first();
        if ($admin && Hash::check($request->input('password'), $admin->password)) {
            Auth::guard('admin')->login($admin);

            return redirect()->route('admin_table')->with('status', 'Logged In successfully as Admin!');
        }

        // Check in User table if not found in Admin
        $user = User::where('email', $request->input('username'))->first();
        if ($user && Hash::check($request->input('password'), $user->password)) {
            Auth::login($user);

            // Handle "remember me" functionality
            if ($request->input('remember')) {
                setcookie("username", $request->input('username'), time() + 3600);
                setcookie("password", $request->input('password'), time() + 3600);
            } else {
                setcookie("username", "");
                setcookie("password", "");
            }

            return redirect()->route('login')->with('status', 'Logged In successfully!');
        }

        // If neither Admin nor User matches
        return redirect()->route('login')->with('status', 'Invalid Credentials!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'You have been logged out!');
    }

    public function logoutAdmin(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'You have been logged out!');
    }

    public function userRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ],
        [
            'name.required' => 'Nama Harap Diisi',
            'name.string' => 'Nama Harap berupa huruf',
            'name.max' => 'Nama tidak boleh melebihi 255 karakter',

            'address.required' => 'Alamat Harap Diisi',
            'address.string' => 'Alamat Harap berupa huruf',
            'address.max' => 'Alamat tidak boleh melebihi 255 karakter',

            'email.required' => 'Email harap diisi',
            'email.string' => 'Email harap berupa huruf',
            'email.email' => 'Harap masukan email yang valid',
            'email.max' => 'Email tidak boleh melebihi 255 karakter',
            'email.unique' => 'Email tersebut sudah ada',

            'password.required' => 'Password harap diisi',
            'password.string' => 'Password harap berupa huruf',
            'password.min' => 'Password minimal 8 huruf',
            'password.confirmed' => 'Password harap ditulis kembali',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator, 'register')
                            ->withInput()
                            ->with('status', 'Invalid Credentials!');
        }

        $user = User::create([
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'money' => 0,
        ]);

        Auth::login($user);

        return redirect()->back()->with('status', 'Registration successful!');
    }

    public function topUp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|string',
            'customAmount' => 'nullable|integer|min:1|max:2147483647',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput()
                            ->with('status', 'Invalid Credentials!');
        }

        $amount = $request->amount === 'custom' ? $request->customAmount : (int)$request->amount;

        if ($amount <= 0) {
            return back()->withErrors(['customAmount' => 'Invalid amount entered.']);
        }

        $user = Auth::user();
        $user->money += $amount;
        $user->save();

        return redirect()->back()->with('status', 'Balance topped up successfully!');
    }
}
