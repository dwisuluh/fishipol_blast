<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\View\View;
use App\Imports\DosenImport;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $dosens = Dosen::all();
            return DataTables::of($dosens)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-primary mx-1 shadow editData" data-toggle="modal" data-target="#edit-dosen" data-id="' . $row->id . '"><i class="icon far fa-fw fa-edit" data-toggle="tooltip"
                data-placement="top" title="Edit"></i></a>';
                    //     $btn = '<a href="' . route('dosen.edit', $row->id) . '" class="btn btn-sm btn-primary mx-1 shadow"><i class="icon far fa-fw fa-edit" data-toggle="tooltip"
                    // data-placement="top" title="Edit"></i></a>';
                    $btn .= '&nbsp;';
                    $btn .= '<a href="javascript:void(0)" data-target="#detailShow#" class="btn btn-success btn-sm mx-1 shadow" data-id="' . $row->id . '"><i class="icon fas fa-fw fa-eye" data-toggle="tooltip"
                    data-placement="top" title="Detail"></i></a>';
                    $btn .= '&nbsp';
                    $btn .= '<a href="javascript:void(0)" class="deleteData btn btn-danger btn-sm mx-1 shadow" data-id="' . $row->id . '"><i class="icon fas fa-fw fa-trash" data-toggle="tooltip"
                data-placement="top" title="Delete"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dosen.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dosen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        // $validator = Validator::make($request->all(),[
        //     'nama' => 'required|array',
        //     'no_hp' => 'required|array',
        //     'email' => 'required|array|email:dns'
        // ]);
        // $validator = Validator::make($request->all(),[
        //     // 'nama' => 'required|array',
        //     'nama.*' => 'required|string',
        //     'nip.*' => 'required|unique:dosens,nip|regex:/^[0-9]*$/',
        //     // 'no_hp' => 'required|array',
        //     'no_hp.*' => 'required|regex:/^([0-9\+]*)$/|min:10|unique:dosens,no_hp',
        //     // 'email' => 'required|array|email:dns',
        //     'email.*' => 'required|email:dns|string'
        // ]);
        // if($validator->fails()){
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }
        // $request->validate([
        //     //     // 'nama' => 'required|array',
        //     'nama.*' => 'required|string',
        //     'nip.*' => 'required|unique:dosens,nip|regex:/^[0-9]*$/',
        //     'nidn.*' => 'required|unique:dosens,nidn|regex:/^[0-9]*$/',
        //     //     // 'no_hp' => 'required|array',
        //     'no_hp.*' => 'required|regex:/^([0-9\+]*)$/|min:10|unique:dosens,no_hp',
        //     //     // 'email' => 'required|array|email:dns',
        //     'email.*' => 'required|email:dns'
        // ]);
        // dd($request);

        // dd($request);
        $validator = Validator::make($request->all(), [
            'nama'  => 'required',
            'nip'   => 'required|unique:dosens,nip|regex:/^[0-9]*$/',
            'nidn'   => 'required|unique:dosens,nip|regex:/^[0-9]*$/',
            'phones' => 'required|regex:/^([0-9\+]*)$/|min:10|unique:dosens,no_hp',
            // 'phones' => 'required|min:10|unique:tendiks,no_hp',
            'email' => 'required|email:dns|unique:dosens,email'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $phones = str_replace([' ', '-'], '', $request->phones);
        Dosen::create([
            'name' => $request->nama,
            'nip' => $request->nip,
            'nidn' => $request->nidn,
            'no_hp' => $phones,
            'email' => $request->email,
        ]);

        // $data = Tendik::all();

        return response()->json([
            'success'   => true,
            'message'   => 'Penambahan Data Dosen Success!',
            // 'data'      => $data,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Dosen $dosen)
    {
        $view = view('dosen.show', compact('dosen'))->render();

        return response()->json([
            'html' => $view
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dosen $dosen)
    {
        // return view('dosen.edit', compact('dosen'));
        return response()->json($dosen);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dosen $dosen)
    {
        $rules = [
            'name' => 'required|string',
        ];
        if ($request->nip != $dosen->nip || $request->nip == null) {
            $rules['nip'] = 'required|unique:dosens,nip|regex:/[0-9]*$/';
        }
        if ($request->nidn != $dosen->nidn) {
            $rules['nidn'] = 'required|unique:dosens,nidn|regex:/^[0-9]*$/';
        }
        if ($request->no_hp != $dosen->no_hp) {
            $rules['no_hp'] = 'required|regex:/^([0-9\+]*)$/|min:10|unique:dosens,no_hp';
        }
        if ($request->email != $dosen->email || $request->email == null) {
            $rules['email'] = 'required|email:dns';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $dosen->update([
            'name' => $request->name,
            'nip' => $request->nip,
            'nidn' => $request->nidn,
            'no_hp' => $request->no_hp,
            'email' => $request->email
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diupdate'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dosen $dosen)
    {
        $dosen->delete();

        return response()->json([
            'success'   => true,
            'message'   => 'Data Dosen Berhasil dihapus..!',
        ]);
    }

    public function importDosen(Request $data)
    {
        $data->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);
        // dd($data);
        $path = $data->file('file');
        Excel::import(new DosenImport, $path);

        return redirect('dosen')->with('success', 'Import Data Kontak Berhasil');
    }
}
