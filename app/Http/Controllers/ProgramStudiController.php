<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Imports\ProdiImport;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProgramStudiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $prodis = ProgramStudi::all();
        return view('prodi.index', compact('prodis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('prodi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'prodi' => 'required|unique:program_studis,nama,NULL,id,jenjang,' . $request->jenjang,
            'departemen' => 'required',
            'kode_prodi' => 'required|max:5|unique:program_studis,kode',
            'jenjang'   => 'required',
        ], ['prodi.unique' => 'Program Studi sudah ada untuk jenjang yang sama.']);

        // dd($request->kode_prodi);

        ProgramStudi::create([
            'nama' => $request->prodi,
            'departemen' => $request->departemen,
            'kode' => $request->kode_prodi,
            'jenjang'   => $request->jenjang,
        ]);

        return redirect('prodi')->with('success', 'Input Data Success...');
        // return response()->json('success', 'Input Data Success...');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProgramStudi $programStudi)
    {
        $view = view('prodi.show', compact('programStudi'))->render();

        return response()->json([
            'html' => $view
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramStudi $programStudi)
    {
        return view('prodi.edit', compact('programStudi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramStudi $programStudi)
    {
        $rules = [];

        if ($request->prodi != $programStudi->nama) {
            $rules['prodi'] = ['required', 'unique:program_studis,nama,NULL,id,jenjang,' . $request->jenjang];
        }

        if ($request->departemen != $programStudi->departemen) {
            $rules['departemen'] = ['required'];
        }

        if ($request->kode_prodi != $programStudi->kode) {
            $rules['kode_prodi'] = ['required'];
        }

        if ($request->jenjang != $programStudi->jenjang) {
            $rules['jenjang'] = ['required', 'unique:program_studis,jenjang,NULL,id,nama,' . $request->prodi];
        }

        $request->validate($rules);

        $programStudi->update([
            'nama' => $request->prodi,
            'departemen' => $request->departemen,
            'kode' => $request->kode_prodi,
            'jenjang'   => $request->jenjang,
        ]);
        return redirect('prodi')->with('success', 'Update Data Success...');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramStudi $programStudi)
    {
        // dd($programStudi);
        $programStudi->delete();

        return response('Program Studi deleted successfully,', 200);

        // return redirect('prodi')->with('success','Data Berhasil dihapus');
    }

    public function import_prodi(Request $data)
    {
        $data->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);
        $path = $data->file('file');
        Excel::import(new ProdiImport, $path);

        return redirect('prodi')->with('success', 'Import Data Program Studi Berhasil');
    }
}
