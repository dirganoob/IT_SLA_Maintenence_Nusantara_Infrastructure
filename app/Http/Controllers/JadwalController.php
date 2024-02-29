<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Carbon;
use App\Models\Jadwal;
use App\Models\Lokasi;


class JadwalController extends Controller
{
    public function jadwal(Request $request)
    {
        $title = 'MUN | Jadwal';
        $pagination = 10;
        $jadwals = DB::table('jadwals')->paginate($pagination);
        return view('pages.jadwal.jadwal', ['jadwals' => $jadwals, 'lokasi' => Lokasi::all()], compact('title'))->with('i', ($request->input('page', 1) - 1) *  $pagination);
    }

    public function addjadwal(Request $request)
    {
        DB::table('jadwals')->insert([
            'namakegiatan' => $request->namakegiatan,
            'tanggalkegiatan' => $request->tanggalkegiatan,
            'tanggalselesai' => $request->tanggalselesai,
            'lokasi_id' => $request->lokasi_id,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_berakhir' => $request->waktu_berakhir

        ]);
        
        Alert::success('Success', 'Data Jadwal Telah berhasil Ditambahkan');
        return redirect('/jadwal');
    }

    public function deletejadwal($id)
    {
        DB::table('jadwals')->where('id', $id)->delete();
        // dd($id);
        Alert::success('Success', 'Data Jadwal Telah berhasil Dihapus');
        return redirect('/jadwal');
    }


    public function updatejadwal(Request $request)
    {
        DB::table('jadwals')->where('id', $request->id)->update([
            'namakegiatan' => $request->namakegiatan,
            'tanggalkegiatan' => $request->tanggalkegiatan,
            'tanggalselesai' => $request->tanggalselesai,
            'lokasi_id' => $request->lokasi_id,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_berakhir' => $request->waktu_berakhir
        ]);
        // dd($request);
        Alert::success('Success', 'Data Jadwal Telah berhasil Diedit');
        return redirect('/jadwal');
    }

    public function printjadwal(Request $request){
        $title = 'MUN | Print Jadwal';
        $jadwals = DB::table('jadwals')->get();
        return view('pages.jadwal.jadwalprint', [
            'jadwals' => $jadwals,
            'lokasi' => Lokasi::all(),
        ], compact('title'))->with('i', ($request->input('page', 1) - 1));
    }
    


    // public function updatejadwal($id)
    // {

    //     $jadwals= DB::table('jadwals')->where('id', $id)->get();

    //     return view('pages.jadwal.jadwal', ['jadwals' => $jadwals]);
    // }

    // public function editlocation($id)
    // {

    //     $location = DB::table('lokasi')->where('id', $id)->get();

    //     return view('pages.jadwal.jadwal', ['jadwal' => $location]);
    // }

    // public function updatelocation(Request $request)
    // {
    //     DB::table('lokasi')->where('id', $request->id)->update([
    //         'nama' => $request->nama,
    //         'singkatan' => $request->singkatan,
    //     ]);
    //     // dd($request);

    //     return redirect('/jadwal');
    // }

    // public function deletelocation($id)
    // {
    //     DB::table('lokasi')->where('id', $id)->delete();
    //     // dd($id);
    //     Alert::success('Success', 'Data Lokasi Telah berhasil dihapus');
    //     return redirect('/jadwal');
    // }

    // public function print_location(Request $request)
    // {
    //     $title = 'Print Page';
     
    //     $date = Carbon::now()->format('d-m-Y');
    //     $location = DB::table('lokasi')->get();

    //     return view('pages.location.printlocation', ['location' => $location, 'date' => $date], compact('title'))->with('i', ($request->input('page', 1) - 1));
    
    //     // return view('pages.location.printlocation');
    
    // }
}