<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Testimony;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TestimonyController extends Controller
{
    public function index() {
        $admin = Auth::guard('admin')->user();

        if($admin){
            $testimonies = Testimony::all();
            return view('admin.testimony.table', compact(['testimonies', 'admin']));
        }

        return redirect()->route('login');
    }

    public function create() {
        $admin = Auth::guard('admin')->user();

        if($admin){
            return view('admin.testimony.add', compact('admin'));
        }

        return redirect()->route('login');
    }

    public function store(Request $request) {

        $request->validate([
            'name' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg',
            'company' => 'required',
            'description' =>  'required'
        ],
        [
            'name.required' => 'Harap Nama diisi',
            'image.required' => 'Gambar Harap diisi',
            'image.mimes' => 'Extension Gambar Harap png, jpg, jpeg',
            'company.required' => 'Perusahaan Harap diisi',
            'description.required' => 'Deskripsi Harap Diisi'
        ]);

        $image = $request->file('image');
        $imgName = time() . "_" . $image->getClientOriginalName();
        $image->move(public_path("img"), $imgName);

        Testimony::create([
            "image" => $imgName,
            "name" =>$request->input('name'),
            'company' => $request->input('company'),
            "description" =>$request->input('description'),
        ]);

        return redirect()->route('testimony_homepage')->with('success', 'Data telah berhasil disimpan!');
    }

    public function delete(Testimony $testimony) {
        $count = Testimony::count();

        if($count <= 4) {
            return redirect()->route('admin_table')->with('success', 'Data gagal dihapus! Tidak boleh kurang dari 4 data!');
        }

        $oldImage = public_path('img/' . $testimony->image);
        unlink($oldImage);

        $testimony->delete();
        return redirect()->route('testimony_homepage')->with('success', 'Data telah berhasil dihapus!');
    }

    public function edit(Testimony $testimony) {
        $admin = Auth::guard('admin')->user();

        if($admin){
            return view('admin.testimony.edit', compact(['testimony', 'admin']));
        }

        return route('login');
    }

    public function update(Request $request, Testimony $testimony) {

        $request->validate([
            'name' => 'required',
            'company' => 'required',
            'description' =>  'required'
        ],
        [
            'name.required' => 'Harap Nama diisi',
            'image.mimes' => 'Extension Gambar Harap png, jpg, jpeg',
            'company.required' => 'Perusahaan Harap diisi',
            'description.required' => 'Deskripsi Harap Diisi'
        ]);

        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $imgName = time() . "_" . $image->getClientOriginalName();
            $image->move(public_path("img"), $imgName);

            $oldImage = public_path('img/' . $testimony->image);
            unlink($oldImage);
        }
        else {
            $imgName = $testimony->image;
        }

        $testimony->update([
            "image" => $imgName,
            "name" =>$request->input('name'),
            'company' => $request->input('company'),
            "description" =>$request->input('description'),
        ]);

        $testimony->save();
        return redirect()->route('testimony_homepage')->with('success', 'Data telah berhasil diperbarui!');
    }

    public function search(Request $request) {

        $admin = Auth::guard('admin')->user();

        if($admin){
            $search = $request->input('search');

            $testimonies = Testimony::where(function($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%");
            })->get();

            return view('admin.testimony.table', compact('testimonies', 'admin'));
        }

        return redirect()->route('login');
    }
}
