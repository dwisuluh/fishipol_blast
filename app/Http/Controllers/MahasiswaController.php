<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\View\View;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use App\Imports\MahasiswaImport;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $mahasiswas = Mahasiswa::join('program_studis', 'mahasiswas.kode_prodi', '=', 'program_studis.kode')
            //     ->get(['mahasiswas.*', 'program_studis.nama as nama_prodi', 'program_studis.jenjang']);

            $mahasiswas = Mahasiswa::with('prodi')->has('prodi')->get();
            // }])->get();

            return DataTables::of($mahasiswas)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="'.route('mahasiswa.edit',$row->id).'" class="btn btn-sm btn-primary mx-1 shadow"><i class="icon far fa-fw fa-edit" data-toggle="tooltip"
                data-placement="top" title="Edit"></i></a>';
                    $btn .= '&nbsp;';
                    $btn .= '<a href="javascript:void(0)" data-toggle="modal" data-target="#detailShow" class="btn btn-success btn-sm mx-1 shadow" data-id="' . $row->id . '"><i class="icon fas fa-fw fa-eye" data-toggle="tooltip"
                    data-placement="top" title="Detail"></i></a>';
                    $btn .= '&nbsp';
                    $btn .= '<a href="javascript:void(0)" class="deleteData btn btn-danger btn-sm mx-1 shadow" data-id="' . $row->id . '"><i class="icon fas fa-fw fa-trash" data-toggle="tooltip"
                data-placement="top" title="Delete"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('mahasiswa.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodis = ProgramStudi::all();
        return view('mahasiswa.create', compact('prodis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'  =>  'required',
            'nim'   =>  'required|min:11|unique:mahasiswas,nim',
            'kodeProdi' =>  'required',
            'angkatan' => 'required|max:4',
            'no_hp' => 'required:unique:mahasiswas,no_hp|regex:/^([0-9\+]*)$/|min:10',
            'email' =>  'required|email:dns|unique:mahasiswas,email'
        ]);

        // dd($request);

        Mahasiswa::create([
            'nama'  => $request->nama,
            'nim'   => $request->nim,
            'no_hp' => $request->no_hp,
            'angkatan' => $request->angkatan,
            'kode_prodi'    => $request->kodeProdi,
            'email' => $request->email,
        ]);

        return redirect('mahasiswa')->with('success', 'Input Data Success...');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load('prodi');
        $view = view('mahasiswa.show', compact('mahasiswa'))->render();

        return response()->json([
            'html' => $view
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        $prodi = ProgramStudi::all();
        return view('mahasiswa.edit', compact(['mahasiswa', 'prodi']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $rules = [
            'nama' => ['required']
        ];

        if($request->nim != $mahasiswa->nim){
            $rules['nim'] = ['required','min:11','unique:mahasiswas,nim'];
        }

        if($request->kodeProdi != $mahasiswa->kode_prodi){
            $rules['kodeProdi'] = ['required'];
        }

        if($request->angkatan != $mahasiswa->angkatan){
            $rules['angkatan'] = ['required','max:4'];
        }

        if($request->no_hp != $mahasiswa->no_hp){
            $rules['no_hp'] = ['required','unique:mahasiswas,no_hp','regex:/^([0-9\+]*)$/','min:10'];
        }

        if($request->email != $mahasiswa->email){
            $rules['email'] = ['required','email:dns','unique:mahaiswas,email'];
        }

        // $request->validate([
        //     'nama'  =>  'required',
        //     'nim'   =>  'required|min:11|unique:mahasiswas,nim',
        //     'kodeProdi' =>  'required',
        //     'angkatan'  => 'required|max:4',
        //     'no_hp' => 'required|unique:mahasiswas,no_hp|regex:/^([0-9\+]*)$/|min:10',
        //     'email' =>  'required|email:dns|unique:mahasiswas,email'
        // ]);

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return redirect('mahasiswa/'.$mahasiswa->id.'/edit')->withErrors($validator)->withInput();
        }

        $mahasiswa->update([
            'nama'  => $request->nama,
            'nim'   => $request->nim,
            'no_hp' => $request->no_hp,
            'angkatan' => $request->angkatan,
            'kode_prodi'    => $request->kodeProdi,
            'email' => $request->email,
        ]);

        return redirect('mahasiswa')->with('success', 'Update Data Success...');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return response('Data Mahasiswa '.$mahasiswa->nama.' deleted successfully', 200);

    }

    public function importData(Request $data)
    {
        $data->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);
        // dd($data);
        $path = $data->file('file');
        Excel::import(new MahasiswaImport, $path);

        return redirect('mahasiswa')->with('success', 'Import Data Mahasiswa Berhasil');
    }
}
