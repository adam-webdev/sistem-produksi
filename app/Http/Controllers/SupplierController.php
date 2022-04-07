<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::all();
        return view('admin.supplier.index', compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add = new Supplier();
        $add->nama = $request->nama;
        $add->alamat = $request->alamat;
        $add->email = $request->email;
        $add->nohp = $request->nohp;
        $add->nama_bank = $request->nama_bank;
        $add->no_rekening = $request->no_rekening;
        $add->save();
        Alert::success('Berhasil', 'Data Berhasil disimpan.');
        return redirect()->route('supplier.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Supplier::findOrFail($id);
        return view('admin.supplier.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Supplier::findOrFail($id);
        $data->nama = $request->nama;
        $data->alamat = $request->alamat;
        $data->email = $request->email;
        $data->nohp = $request->nohp;
        $data->nama_bank = $request->nama_bank;
        $data->no_rekening = $request->no_rekening;
        $data->save();
        Alert::success('Berhasil', 'Data Berhasil diupdate.');
        return redirect()->route('supplier.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data = Supplier::findOrFail($id);
        $data->delete();
        Alert::success('Berhasil', 'Data Berhasil dihapus.');
        return redirect()->route('supplier.index');
    }
}