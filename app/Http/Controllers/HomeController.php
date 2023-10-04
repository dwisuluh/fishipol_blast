<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;

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
        $mahasiswa = Kontak::where('jenis',3)->count();
        $pegawai = Kontak::where('jenis',2)->count();
        $dosen = Kontak::where('jenis',1)->count();
        $total = $mahasiswa + $dosen + $pegawai;
        return view('home', compact(['dosen','pegawai','mahasiswa','total']));
    }

}
