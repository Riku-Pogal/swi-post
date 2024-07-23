<?php

namespace App\Http\Controllers;

use App\Models\Terapis;
use Illuminate\Http\Request;

class TerapisController extends Controller
{
    public function index()
    {
        $datas = Terapis::all();
        return view('pages.terapis',[
            'datas' => $datas,
        ]);
    }

    public function post(Request $request){
        Terapis::create([
            'tkode' => $request->tkode,
            'nama_terapis' => $request->nama_terapis,
            'alamat' => $request->alamat,
            'phone' => $request->hp,
            'underwear' => $request->underwear,
        ]);
        return redirect()->back()->with('success', 'Data berhasil di Simpan');
    }

    public function getedit(Terapis $terapis){
        return view('pages.terapisedit',[
            'terapis' => $terapis,
        ]);
    }

    public function update(Terapis $terapis){
        Terapis::where('id', '=', $terapis->id)->update([
            'tkode' => request('tkode'),
            'nama_terapis' => request('nama_terapis'),
            'alamat' => request('alamat'),
            'phone' => request('hp'),
            'underwear' => request('underwear'),
        ]);        
        return redirect()->route('terapis')->with('success', 'Data berhasil di Update'); 
    }

    public function delete(Terapis $terapis){
        Terapis::find($terapis->id)->delete();
        return redirect()->route('terapis')->with('success', 'Data berhasil di Delete');
    }

    public function  getterapis(Request $request){
        $nama_terapis = $request->nama_terapis;
        if($nama_terapis == ''){
            $jasa = Terapis::select('id','tkode','nama_terapis','alamat','phone','underwear',)->orderBy('nama_terapis', 'asc')->limit(20)->get();
        }else{
            $jasa = Terapis::select('id','tkode','nama_terapis','alamat','phone',)->where('nama_terapis','=',$nama_terapis)->limit(20)->get();
        }
        return json_encode($jasa);
    }
}
