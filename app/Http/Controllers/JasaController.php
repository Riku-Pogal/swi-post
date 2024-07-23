<?php

namespace App\Http\Controllers;
use App\Models\Jasa;
use Illuminate\Http\Request;

class JasaController extends Controller
{
    public function index()
    {
        $datas = Jasa::all();
        return view('pages.jasa',[
            'datas' => $datas,
        ]);
    }

    public function post(Request $request){
        Jasa::create([
            'kode_jasa' => $request->kode_jasa,
            'nama_jasa' => $request->nama_jasa,
            'hrg_jual' => $request->hrg_jual,
            'detail'  => $request->detail,
        ]);
        
        return redirect()->back()->with('success', 'Data berhasil di Simpan');
    }

    public function getedit(Jasa $jasa){
        return view('pages.jasaedit',[
            'jasa' => $jasa,
        ]);
    }

    public function update(Jasa $jasa){
        Jasa::where('id', '=', $jasa->id)->update([
            'kode_jasa' => request('kode_jasa'),
            'nama_jasa' => request('nama_jasa'),
            'hrg_jual' => (float) str_replace(',', '', request('hrg_jual')),
            'detail'  => request('detail'),

        ]);        
        return redirect()->route('jasa')->with('success', 'Data berhasil di Update'); 
    }


public function delete(Jasa $jasa){
    Jasa::find($jasa->id)->delete();
    return redirect()->route('jasa')->with('success', 'Data berhasil di Delete');
}

public function  getjasa(Request $request){
    $nama_jasa = $request->nama_jasa;
    if($nama_jasa == ''){
        $jasa = Jasa::select('id','kode_jasa','nama_jasa','hrg_jual','detail')->orderBy('nama_jasa', 'asc')->limit(20)->get();
    }else{
        $jasa = Jasa::select('id','kode_jasa','nama_jasa','hrg_jual','detail')->where('nama_jasa','=',$nama_jasa)->limit(20)->get();
    }
    return json_encode($jasa);

}
}