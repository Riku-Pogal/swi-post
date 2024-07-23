<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Penjualan_d;
use App\Models\Terapis;
use App\Models\Jasa;
use App\Models\Room;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index()
    {
        $jasa = Jasa::all();
        $terapis = Terapis::all();
        $room = Room::all();
        $no_doc = DB::select("select fgetcode('penjualan') as codedoc");
        return view('pages.penjualan',[
            'jasa' => $jasa,
            'terapis' => $terapis,
            'room' => $room,
            'no_doc' => $no_doc,
        ]);
    }

    public function post(Request $request){
        // dd($request->all());
        $no_doc = DB::select("select fgetcode('penjualan') as codedoc");
        foreach($no_doc as $no_doc){
            $no_doc = $no_doc->codedoc;
        }
        $checkexist = Penjualan::select('id','no_doc')->where('no_doc','=', $no_doc)->first();
        if($checkexist == null){
            Penjualan::create([
                'no_doc' => $no_doc,
                'tgl_doc' => $request->tgl_doc,
                'nama_terapis' => $request->pengiriman,
                'nama' => $request->nama,
                'grandtot' => (float) str_replace(',', '', $request->grandtot),
            ]);
            $idh_loop = Penjualan::select('id')->where('no_doc','=',$no_doc)->get();
            for($j=0; $j<sizeof($idh_loop); $j++){
                $idh = $idh_loop[$j]->id;
            }
    
            $countrows = sizeof($request->nama_jasa_d);
            $count=0;
            for ($i=0;$i<sizeof($request->nama_jasa_d);$i++){
                Penjualan_d::create([
                    'idh' => $idh,
                    'nama_jasa' => $request->nama_jasa_d[$i],
                    'qty' => $request->qty_d[$i],
                    'hrg_jual' => (float) str_replace(',', '', $request->hrg_jual_d[$i]),
                    'total' => (float) str_replace(',', '', $request->total_d[$i]),
                ]);
                $count++;
            }
            // Tsob_h::where('no', '=', $request->nosob)->update([
            //     'exist_sj' => "Y",
            // ]);
            if($count == $countrows){
                return redirect()->back()->with('success', 'Data berhasil ditambahkan');
            }
        }
        return redirect()->back()->with('error', 'Nomor transaksi sudah ada!');
    }

    public function getedit(Penjualan $penjualan){
        // dd($penjualan);
        $penjualands = Penjualan_d::select('id','idh','nama','quantity','harga','total',)->where('idh','=',$penjualan->id)->get();
        $jasa = Jasa::all();
        $terapis = Terapis::all();
        $room = Room::all();
        return view('pages.penjualanedit',[
            'penjualan' => $penjualan,
            'penjualands' => $penjualands,
            'jasa' => $jasa,
            'terapis' => $terapis,
            'room' => $room,
        ]);
    }

    public function update(Penjualan $penjualan){
        // dd(request()->all());
        // dd($penjualan->id);
        DB::delete('delete from penjualan_ds where idh = ?', [$penjualan->id] );
        Penjualan::where('id', '=', $penjualan->id)->update([
            'no_bon' => request('no_bon'),
            'tgl_bon' => request('tgl_bon'),
            'phone' => request('hp'),
            'pemesan' => request('pemesan'),
            'pengiriman' => request('pengiriman'),
            'alamat' => request('alamat'),
            'grandtot' => (float) str_replace(',', '', request('grandtot')),
        ]);  
        $count=0;
        for ($i=0;$i<sizeof(request('id_d'));$i++){
            if(request('deleted_item_d')[$i] != request('id_d')[$i]){
                Penjualan_d::create([
                    'idh' => $penjualan->id,
                    'nama' => request('nama_kartu_d')[$i],
                    'quantity' => request('qty_d')[$i],
                    'satuan' => request('satuan_d')[$i],
                    'harga' => (float) str_replace(',', '', request('hrgjual_d')[$i]),
                    'total' => (float) str_replace(',', '', request('total_d')[$i]),
                ]);
                $count++;
            }
        }
        
        return redirect()->route('penjualan')->with('success', 'Data berhasil di Update'); 
    }

    public function list(){
        $penjualans = Penjualan::select('id','no_bon','tgl_bon','pengiriman','phone','pemesan','nama','alamat','grandtot',)->orderBy('created_at', 'asc')->get();
        $penjualands = Penjualan_d::select('id','idh','nama','quantity','harga','total','satuan',)->get();
        return view('pages.penjualanlist',[
            'penjualans' => $penjualans,
            'penjualands' => $penjualands
        ]);
    }

    public function delete(Penjualan $penjualan){
        Penjualan::find($penjualan->id)->delete();
        DB::delete('delete from penjualan_ds where idh = ?', [$penjualan->id] );
        return redirect()->route('produk')->with('success', 'Data berhasil di Delete');
    }

    public function printpdfpenjualan(Penjualan $penjualan){
        // dd($penjualan);
        $penjualands = Penjualan_d::where('idh','=',$penjualan->id)->get();
        // dd($penjualands);
        // 1 inch = 72 point
        // 1 inch = 2.54 cm
        // 10 cm = 10/2.54*72 = 283.464566929
        // 20 cm = 10/2.54*72 = 566.929133858
        $customPaper = array(0,0,226.7,850.3);
        $pdf = Pdf::loadView('pages.Print.penjualanprintpdf', [
            'penjualan' => $penjualan,
            'penjualands'=> $penjualands,
            // 'address'=> $address
            ])->setPaper($customPaper, 'portrait');
        return $pdf->stream("Penjualan/".$penjualan->no);
    }
}
