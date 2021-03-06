<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BrandsController extends Controller
{
    public function index(){
        $request = Http::get('http://localhost/Gudang-Backend/API/Brands');
        $Brands = json_decode($request->body(), true);
        return view('admin/brands', ['Brands' => $Brands]);
    }

    public function add(Request $request)
    {
        $client = Http::post('http://localhost/Gudang-Backend/API/Brands', [
            'brand_name' => $request->name,
            'company' => $request->company,
            'address' => $request->address,
            'phone' => $request->phone
        ]);

        if ($client->status() == 200) {
            return redirect('/Brands');
        } else {
            return redirect('/Dashboard');
        }
    }

    public function update($id, Request $request){
        $client = Http::asForm()->put('http://localhost/Gudang-Backend/API/Brands', [
            'id' => $id,
            'brand_name' => $request->name,
            'company' => $request->company,
            'address' => $request->address,
            'phone' => $request->phone
        ]);

        if ($client->successful()) {
            return redirect('/Brands');
        } else {
            return redirect('/Dashboard');
        }
    }

    public function hapus($id)
    {
        $client = Http::asForm()->delete('http://localhost/Gudang-Backend/API/Brands', [
            'id' => $id
        ]);

        if ($client['status'] == 'success') {
            return redirect('/Brands');
        } else {
            return redirect('/Dashboard');
        }
    }
}
