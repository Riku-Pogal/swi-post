<?php

namespace App\Http\Controllers;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $datas = Room::all();
        return view('pages.Room',[
            'datas' => $datas,
        ]);
    }

    public function post(Request $request){
        Room::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'kapasitas' => $request->kapasitas,
            'jenis' => $request->jenis,
        ]);
        
        return redirect()->back()->with('success', 'Data berhasil di Simpan');
    }

    public function getedit(Room $room){
        return view('pages.roomedit',[
            'room' => $room,
        ]);
    }

    public function update(Room $room){
        Room::where('id', '=', $room->id)->update([
            'kode' => request('kode'),
            'nama' => request('nama'),
            'kapasitas' => request('kapasitas'),
            'jenis' => request('jenis'),
        ]);        
        return redirect()->route('room')->with('success', 'Data berhasil di Update'); 
    }


public function delete(Room $room){
    Room::find($room->id)->delete();
    return redirect()->route('room')->with('success', 'Data berhasil di Delete');
}

public function  getroom(Request $request){
    $room = $request->room;
    if($room == ''){
        $room = Room::select('id','kode','nama','kapasitas','jenis',)->orderBy('nama', 'asc')->limit(20)->get();
    }else{
        $room = Room::select('id','kode','nama','kapasitas','jenis')->where('nama','=',$room)->limit(20)->get();
    }
    return json_encode($room);

}
}