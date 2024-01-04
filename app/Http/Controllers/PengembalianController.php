<?php

namespace App\Http\Controllers;

use App\model\pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\sparepart;


class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('pengembalian')
            ->join('sparepart', 'sparepart.kode_barang', '=', 'pengembalian.kode_barang')
            ->get();

        // dd($data);
        return view('pengembalian.index')->with('data', $data);
    }

    public function kembali()
    {
        $data['result'] = sparepart::all();
        return view('pengembalian.form')->with($data);
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
        pengembalian::create($data);

        return redirect('pengembalian')->with('toast_success', 'Berhasil Mengajukan!');
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
            $sparepart->jumlah += $request->jumlah_dikembalikan;
            $sparepart->save();

            $results = pengembalian::where('id_pengembalian', $request->id_pengembalian)->first();
            $status = $results->update($data);

            return redirect('pengembalian')->with('toast_success', 'Sukses !');
        } else {
            $results = pengembalian::where('id_pengembalian', $request->id_pengembalian)->first();
            $status = $results->update($data);

            return redirect('pengembalian')->with('toast_success', 'Sukses !');
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
