<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\peminjaman;
use App\Model\pengembalian;
use App\Model\sparepart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['result'] = sparepart::all();
        return view('home')->with($data);
    }
}
