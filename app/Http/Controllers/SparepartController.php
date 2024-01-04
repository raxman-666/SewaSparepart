<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\sparepart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SparepartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sparepart = sparepart::all();
        $q = DB::table('sparepart')->select(DB::raw('MAX(RIGHT(kode_barang,3)) as kode'));
        $kd = "";
        if ($q->count() > 0) {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kode) + 1;
                $huruf = "BRG";
                $kd = $huruf . sprintf("%03s", $tmp);
            }
        } else {
            $kd = "BRG001";
        }

        $data['result'] = sparepart::all();
        return view('sparepart.index', compact('kd'), ['title' => 'Sparepart'])->with($data);
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
        $data = $request->validate([
            'kode_barang' => 'required',
            'image' => 'mimes:jpeg,jpg,png',
            'nama' => 'required',
            'jenis_barang' => 'required',
            'jumlah' => 'required'
        ]);

        $file = $request->file('image');
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $data['image'] = $file->storeAs('sparepart-images', $fileName);
        $data['image'] = $fileName;


        // sparepart::create($validateData);
        // $input = $request->all();
        $status = \App\Model\sparepart::create($data);

        return redirect('sparepart')->with('toast_success', 'Data Berhasil Ditambahkan!');
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
        $data = $request->validate([
            'nama' => 'required',
            'jenis_barang' => 'required',
            'jumlah' => 'required'
        ]);

        // dd($request->all());

        if ($request->file('image')) {

            Storage::delete('sparepart-images/' . $request->gambarLama);

            $file = $request->file('image');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $data['image'] = $file->storeAs('sparepart-images', $fileName);
            $data['image'] = $fileName;
        } else {
            $data['image'] = $request->gambarLama;
        }


        $results = sparepart::where('kode_barang', $request->kode_barang)->first();
        $status = $results->update($data);

        return redirect('sparepart')->with('toast_success', 'Data Berhasil Diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $sparepart = \App\Model\sparepart::where('kode_barang', $request->kode)->first();
        $status = $sparepart->delete();

        Storage::delete('sparepart-images/' . $request->gambarLama);

        return redirect('sparepart')->with('toast_success', 'Data Berhasil Dihapus!');


        // $result = \App\Model\sparepart::where('id', $request->id_hapus)->first();
        // $status = $result->delete();

    }    // return redirect('sparepart');
}
