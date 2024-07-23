<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    //
    public function index(){
        return view('pages.pengeluaran');
    }
    public function post(Request $request){
        // dd($request->all());
        Pengeluaran::create([   
           'tgl_1' => $request->tanggal_1, 
           'nama_pemilik' => $request->nama_pemilik,
           'nama_toko' => $request->nama_toko,
           'harga'=> (float) str_replace(' ', '-', $request->harga),
        ]);
        return redirect()->back()->with('success','Data Berhasil ditambahkan!');
}


public function list(){
    $pengeluaran = Pengeluaran::select('id','tgl_1','nama_pemilik','nama_toko','harga',)->get();
    // dd($pengeluaran);
    return view('pages.pengeluaranlist',[
        'pengeluaran' => $pengeluaran,
    ]);
}

public function getedit(Pengeluaran $pengeluaran){
    // dd($pemasukan);
    return view('pages.pengeluaranedit',[ 'pengeluaran' => $pengeluaran]);
}

public function update(Pengeluaran $pengeluaran){
    Pengeluaran::where('id', '=', $pengeluaran->id)->update([
        'tgl_1' => request('tanggal_1'),
        'nama_pemilik' =>  request('nama_pemilik'),
        'nama_toko' =>  request('nama_toko'),
        'harga' => (float) str_replace(',', '', request('harga')) ,
    ]);

    return redirect()->route('pengeluaranlist');
}
public function delete(Pengeluaran $pengeluaran){
    Pengeluaran::find($pengeluaran->id)->delete();

    return redirect()->route('pengeluaranlist');
}
}