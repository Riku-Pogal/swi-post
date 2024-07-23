<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use Illuminate\Http\Request;

class PemasukanController extends Controller
{
    public function index(){
        return view('pages.pemasukan');
    }
    public function post(Request $request){
        Pemasukan::create([  
            'tgl_1' => $request->tanggal_1,
            'tgl_2' => $request->tgl_2,
            'nama_toko' => $request->nama_toko,
            'harga' => (float) str_replace(',', '', $request->harga),
            'catatan' => ($request->catatan),
        ]);
        return redirect()->back()->with('success','Data Berhasil ditambahkan!');
    }

    public function list(){
        $pemasukans = Pemasukan::select('id','tgl_1','tgl_2','nama_toko','harga','catatan')->get();
        return view('pages.pemasukanlist',[
            'pemasukans' => $pemasukans,
        ]);
    }

    public function getedit(Pemasukan $pemasukan){
        dd($pemasukan);
        return view('pages.pemasukanedit',[ 'pemasukan' => $pemasukan]);
    }

    public function update(Pemasukan $pemasukan){
        Pemasukan::where('id', '=', $pemasukan->id)->update([
            'tgl_1' => request('tanggal_1'),
            'tgl_2' =>  request('tgl_2'),
            'nama_toko' =>  request('nama_toko'),
            'harga' => (float) str_replace(',', '', request('harga')) ,
        ]);

        return redirect()->route('pemasukanlist');
    }

    public function delete(Pemasukan $pemasukan){
        Pemasukan::find($pemasukan->id)->delete();

        return redirect()->route('pemasukanlist');
    }
}
