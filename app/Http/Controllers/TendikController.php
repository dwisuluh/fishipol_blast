<?php

namespace App\Http\Controllers;

use App\Models\Tendik;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Imports\TendikImport;
use Exception;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class TendikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $tendiks = Tendik::all();

        if ($request->ajax()) {
            // $data = Tendik::all();
            $data = Tendik::orderBy('name', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="editData btn btn-primary btn-sm" data-id="' . $row->id . '"><i class="far fa-fw fa-edit" data-toggle="tooltip"
                        data-placement="top" title="Edit"></i></a>';
                    $btn .= '&nbsp;';
                    $btn .= '<a href="javascript:void(0)" class="deleteData btn btn-danger btn-sm" data-id="' . $row->id . '"><i class="fa fa-fw fa-trash" data-toggle="tooltip"
                        data-placement="top" title="Delete"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('tendik.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('tendik');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'nama'  => 'required',
            // 'nip'   => 'required|unique:tendiks,nip|regex:/^[0-9]*$/',
            // 'phones' => 'required|regex:/^([0-9\+]*)$/|min:10|unique:tendiks,no_hp',
            'phones' => 'required|min:10|unique:tendiks,no_hp',
            // 'email' => 'required|email:dns|unique:tendiks,email'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $phones = str_replace([' ', '-'], '', $request->phones);
        Tendik::create([
            'name' => $request->nama,
            'nip' => $request->nip,
            'no_hp' => $phones,
            'email' => $request->email,
        ]);

        // $data = Tendik::all();

        return response()->json([
            'success'   => true,
            'message'   => 'Add Data Tenaga Kependidikan Success!',
            // 'data'      => $data,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tendik $tendik): JsonResponse
    {
        return response()->json([
            'success'   => true,
            'message'   => 'Detail Data Tenaga Kependidikan',
            'data'      => $tendik
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tendik $tendik)
    {
        // dd($tendik);
        return response()->json($tendik);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tendik $tendik)
    {
        $rules = [
            'nama' => ['required']
        ];

        if ($request->nip != $tendik->nip) {
            $rules['nip'] = ['required', 'unique:tendiks,nip'];
        }

        if ($request->phones != $tendik->no_hp) {
            $rules['phones'] = ['required', 'regex:/^([0-9\+]*)$/', 'min:10', 'unique:tendiks,no_hp'];
        }

        if ($request->email != $tendik->email) {
            $rules['email'] = ['required', 'email:dns', 'unique:tendiks,email'];
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $no_hp = preg_replace('/[-\s]/', '', $request->phones);

        $tendik->update([
            'name' => $request->nama,
            'nip' => $request->nip,
            'no_hp' => $no_hp,
            'email' => $request->email,
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Update Data Tenaga Kependidikan Success!',
            // 'data'      => $data,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tendik $tendik)
    {
        try {

            $tendik->delete();

            return response()->json([
                'success'   => true,
                'message'   => 'Data Tenaga Kependidikan Berhasil dihapus..!',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Terjadi kesalahan pada server.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function reload()
    {
        $data = Tendik::all();

        return response()->json($data);
    }

    public function import(Request $data)
    {
        $data->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);
        // dd($data);
        $path = $data->file('file');
        Excel::import(new TendikImport, $path);

        return redirect('tendik')->with('success', 'Import Data Pegawai Berhasil');
    }
}
