<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\Booking_ds;
use App\Models\Jasa;
use App\Models\Room;
use App\Models\Terapis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index()
    {
        $jasa = Jasa::all();
        $room = Room::all();
        // dd($room);
        $terapis=Terapis::all();
        $no_doc = DB::select("select fgetcode('bookings') as codedoc");
        return view('pages.booking',[
            'jasa' => $jasa,
            'room' => $room,
            'terapis' => $terapis,
            'no_doc' => $no_doc,
        ]);
    }

    public function post(Request $request){
        // dd($request->all());
        $no_doc = DB::select("select fgetcode('booking') as codedoc");
        foreach($no_doc as $no_doc){
            $no_doc = $no_doc->codedoc;
        }
        $checkexist = Booking::select('id','no_doc')->where('no_doc','=', $no_doc)->first();
        if($checkexist == null){
            Booking::create([
                'no_doc' => $no_doc,
                'tgl_doc' => $request->tgl_doc,
            ]);
            $idh_loop = Booking::select('id')->where('no_doc','=',$no_doc)->get();
            for($j=0; $j<sizeof($idh_loop); $j++){
                $idh = $idh_loop[$j]->id;
            }
    
            $countrows = sizeof($request->nama_jasa_d);
            $count=0;
            for ($i=0;$i<sizeof($request->nama_jasa_d);$i++){
                Booking_ds::create([
                    'idh' => $idh,
                    'nama_jasa'=> $request -> nama_jasa_d[$i],
                    'hrg_jual' =>$request->hrg_jual_d[$i],
                    'nama_terapis'=> $request -> nama_terapis_d[$i],
                    'nama' => $request -> nama_d[$i],
                    'qty' => $request -> qty_d[$i],
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

    public function getedit(Booking $booking){
        // dd($stock);
        $booking_ds= Booking_ds::select('id','idh','nama_jasa','hrg_jual','nama_terapis','nama','qty')->where('id','=',$booking->idh)->get();
        $room = Room::all();
        $jasa = Jasa::all();
        $terapis = Terapis::all();
        return view('pages.stockedit',[
            'booking' => $booking,
            'booking_ds' => $booking_ds,
            'room' => $room,
            'jasa' => $jasa,
            'terapis' => $terapis,

        ]);
    }

    public function update(Booking $booking){
        // dd(request()->all());
        // dd($penjualan->id);
        DB::delete('delete from booking_ds where id = ?', [$booking->idh] );
        Booking::where('id', '=', $booking->id)->update([
            'no_doc' => request('no_doc'),
            'tgl_doc' => request('tgl_doc'),
        ]);  
        $count=0;
        for ($i=0;$i<sizeof(request('nama_jasa'));$i++){
            Booking_ds::create([
                'idh' => $booking->id,
                'nama_jasa' => request('nama_jasa_d')[$i],
                'hrg_jual' => request('hrg_jual_d')[$i],
                'nama_terapis' => request('nama_terapis_d')[$i],
                'nama' => request('nama_d')[$i],
                'qty' => request('qty_d')[$i],
            ]);
            $count++;
        }
        
        return redirect()->route('booking')->with('success', 'Data berhasil di Update'); 
    }


    public function list(){
        $booking = Booking::select('id','no_doc','tgl_doc')->orderBy('created_at', 'asc')->get();
        $booking_ds = Booking_ds::select('id','idh','nama_jasa','hrg_jual','nama_terapis','nama','qty')->get();
        return view('pages.bookinglist',[
            'booking' => $booking,
            'booking_ds' => $booking_ds
        ]);
    }

    public function delete(Booking $booking){
        Booking::find($booking->id)->delete();
        DB::delete('delete from stock_ds where idh = ?', [$booking->id] );
        return redirect()->route('bookinglist')->with('success', 'Data berhasil di Delete');
    }
}
