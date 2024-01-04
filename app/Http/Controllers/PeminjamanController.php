<?php

namespace App\Http\Controllers;

use App\model\peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\sparepart;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('peminjaman')
            ->join('sparepart', 'sparepart.kode_barang', '=', 'peminjaman.kode_barang')
            ->get();

        // dd($data);
        return view('peminjaman.index')->with('data', $data);
    }

    public function pinjam()
    {
        $data['result'] = sparepart::all();
        return view('peminjaman.form')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $sparepart = sparepart::where('kode_barang', $request->kode_barang)->first();

        if ($request->jumlah_dipinjam > $sparepart->jumlah) {
            return redirect('tambahpinjaman')->with('toast_error', 'Stok barang tidak mencukupi !');
        } else {
            $pinjam = \App\Model\peminjaman::create($data);

            return redirect('peminjaman')->with('toast_success', 'Berhasil Mengajukan!');
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all();

        if ($request->stat == 'Menerima') {
            $sparepart = sparepart::where('kode_barang', $request->kode_barang)->first();
            $sparepart->jumlah -= $request->jumlah_dipinjam;
            $sparepart->save();

            $results = peminjaman::where('id_peminjaman', $request->id_peminjaman)->first();
            $status = $results->update($data);

            return redirect('peminjaman')->with('toast_success', 'Sukses !');
        } else {
            $results = peminjaman::where('id_peminjaman', $request->id_peminjaman)->first();
            $status = $results->update($data);

            return redirect('peminjaman')->with('toast_error', 'gagal !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
