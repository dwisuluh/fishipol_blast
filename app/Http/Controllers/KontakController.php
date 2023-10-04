<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kontak;
use App\Models\Tendik;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Imports\KontakImport;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class KontakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if ($request->ajax()) {

        //     $jenisMap = [
        //         1 => 'Dosen',
        //         2 => 'Tenaga Kependidikan',
        //         3 => 'Mahasiswa',
        //         4 => 'Alumni',
        //         5 => 'Luar Kontak'
        //     ];

        //     $data = Kontak::all()
        //         ->map(function ($user) use ($jenisMap) {
        //             $user->jenis_text =  $jenisMap[$user->jenis];
        //             return $user;
        //         });

        //     return DataTables::of($data)
        //         ->addIndexColumn()
        //         ->addColumn('action', function ($row) {
        //             $btn = '<a href="javascript:void(0)" class="editData btn btn-primary btn-sm" data-id="' . $row->id . '"><i class="far fa-fw fa-edit" data-toggle="tooltip"
        //         data-placement="top" title="Edit"></i></a>';
        //             $btn .= '&nbsp;';
        //             $btn .= '<a href="javascript:void(0)" class="deleteData btn btn-danger btn-sm" data-id="' . $row->id . '"><i class="fa fa-fw fa-trash" data-toggle="tooltip"
        //         data-placement="top" title="Delete"></i></a>';
        //             return $btn;
        //         })
        //         ->rawColumns(['action'])
        //         ->make(true);
        // }

        return view('kontak.index');
    }

    public function getDosen(Request $request)
    {
        $jenisMap = [
            1 => 'Dosen',
            2 => 'Tenaga Kependidikan',
            3 => 'Mahasiswa',
            4 => 'Alumni',
            5 => 'Luar Kontak'
        ];

        $data = Kontak::where('jenis', 1)->get();

        $data = $data->map(function ($item) use ($jenisMap) {
            $item->jenis_text = $jenisMap[$item->jenis];
            return $item;
        });

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

    public function getPegawai(Request $request)
    {
        $jenisMap = [
            1 => 'Dosen',
            2 => 'Tenaga Kependidikan',
            3 => 'Mahasiswa',
            4 => 'Alumni',
            5 => 'Luar Kontak'
        ];

        $data = Kontak::where('jenis', 2)->get();

        $data = $data->map(function ($item) use ($jenisMap) {
            $item->jenis_text = $jenisMap[$item->jenis];
            return $item;
        });

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

    public function getMahasiswa(Request $request)
    {
        $jenisMap = [
            1 => 'Dosen',
            2 => 'Tenaga Kependidikan',
            3 => 'Mahasiswa',
            4 => 'Alumni',
            5 => 'Luar Kontak'
        ];

        // $data = Kontak::where('jenis',3)->get();
        $data = Kontak::with(['mahasiswa.prodi'])->where('jenis', 3)->get();

        $data = $data->map(function ($item) use ($jenisMap) {
            $item->jenis_text = $jenisMap[$item->jenis];
            return $item;
        });

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="javascript:void(0)" class="moveAlumni btn btn-success btn-sm" data-contact-id="' . $row->id . '"><i class="fas fa-fw fa-arrow-right" data-toggle="tooltip"
            data-placement="top" title="Edit"></i> Move to Alumni</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function updateAlumni(Kontak $kontak)
    {
        // $kontak = Kontak::findOrFail($id);

        try {
            $kontak->jenis = 4;
            $kontak->save();

            return response()->json(['message' => 'Data Mahasiswa Berhasil dipindah ke Alumni','success' => true]);
            // Kode untuk mengubah status kontak
        } catch (\Exception $e) {
            dd($e->getMessage()); // Tampilkan pesan kesalahan
        }
    }

    public function getNon(Request $request)
    {
        $jenisMap = [
            1 => 'Dosen',
            2 => 'Tenaga Kependidikan',
            3 => 'Mahasiswa',
            4 => 'Alumni',
            5 => 'Luar Kontak'
        ];

        // $data = Kontak::where('jenis',3)->get();
        $data = Kontak::with(['mahasiswa.prodi'])->where('jenis', 4)->orWhere('jenis', 5)->get();

        $data = $data->map(function ($item) use ($jenisMap) {
            $item->jenis_text = $jenisMap[$item->jenis];
            return $item;
        });

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
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Kontak $kontak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kontak $kontak)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kontak $kontak)
    {
        $kontak->jenis = 4;
        $kontak->save();

        return response()->json(['status' => $kontak->jenis]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kontak $kontak)
    {
        $kontak->delete();
    }

    public function importData(Request $data)
    {
        $data->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);
        // dd($data);
        $path = $data->file('file');
        Excel::import(new KontakImport, $path);

        return redirect('kontak')->with('success', 'Import Data Kontak Berhasil');
    }

    public function dataSync()
    {
        return view('kontak.sync');
    }
    public function getCount(Request $request)
    {
        // $mahasiswa = Mahasiswa::doesntHave('kontak')->count();

        // $mahasiswa = DB::table('mahasiswas')
        //     ->leftJoin('kontaks', 'mahasiswas.id', '=', 'kontaks.mahasiswa_id')
        //     ->select('mahasiswas.*')
        //     ->whereNull('kontaks.id')
        //     ->count();

        $mahasiswa = Mahasiswa::leftJoin('kontaks', function ($join) {
            $join->on('mahasiswas.id', '=', 'kontaks.mahasiswa_id');
            // ->where('kontak.kontakable_type', '=', 'mahasiswa');
        })
            ->whereNull('kontaks.id')
            ->count();
        $pegawai = Tendik::leftJoin('kontaks', function ($join) {
            $join->on('tendiks.id', '=', 'kontaks.tendik_id');
            // ->where('kontak.kontakable_type', '=', 'mahasiswa');
        })
            ->whereNull('kontaks.id')
            ->count();
        $dosen = Dosen::leftJoin('kontaks', function ($join) {
            $join->on('dosens.id', '=', 'kontaks.dosen_id');
            // ->where('kontak.kontakable_type', '=', 'mahasiswa');
        })
            ->whereNull('kontaks.id')
            ->count();

        // $pegawai = DB::table('tendiks')
        //         ->leftJoin('kontaks', 'tendiks.id', '=', 'kontaks.tendik_id')
        //         ->select('tendiks.*')
        //         ->whereNull('kontaks.id')
        //         ->count();
        // $mahasiswa = Mahasiswa::doesntHaveUsingJoins('kontak')->count();

        // $mahasiswa = DB::table('mahasiswas')->count();

        // $mahasiswa = DB::table('mahasiswas')
        //     ->whereNotIn('id', function ($query) {
        //         $query->select('mahasiswa_id')->from('kontaks');
        //     })
        //     ->count();

        // $mahasiswa = DB::table('mahasiswas')
        // ->whereNotExists(function($query){
        //     $query->select(DB::raw(1))
        //           ->from('kontaks')
        //           ->whereRaw('kontaks.mahasiswa_id = mahasiswas.id');
        // })
        // ->count();
        // $pegawai = DB::table('tendiks')
        //     ->whereNotExists(function ($query) {
        //         $query->select(DB::raw(1))
        //             ->from('kontaks')
        //             ->whereRaw('kontaks.tendik_id = tendiks.id');
        //     })
        //     ->count();
        // $dosen = DB::table('dosens')
        //     ->whereNotExists(function ($query) {
        //         $query->select(DB::raw(1))
        //             ->from('kontaks')
        //             ->whereRaw('kontaks.dosen_id = dosens.id');
        //     })
        //     ->count();
        // $pegawai = DB::table('tendiks')
        //     ->whereNotIn('id', function ($query) {
        //         $query->select('tendik_id')->from('kontaks');
        //     })
        //     ->count();


        // $sql = $pegawai->toSql();

        // dd($sql);
        // $dosen = Dosen::doesntHave('kontak')->count();
        // $dosen = DB::table('dosens')
        //     ->whereNotIn('id', function ($query) {
        //         $query->select('dosen_id')->from('kontaks');
        //     })
        //     ->count();

        // $kontak = DB::table(DB::raw("(select $pegawai as count union select $mahasiswa) as temp"))
        //     ->sum('count');

        // dd($kontak);
        // $pegawai = Tendik::doesntHave('kontak')->count();
        // $pegawai = \DB::table('tendiks')
        //             ->whereNotIn('id', function($query){
        //                 $query->select('tendik_id')->from('kontaks');
        //             })
        //             ->count();
        //             dd($pegawai);
        $total = $mahasiswa + $dosen + $pegawai;

        return response()->json([
            'mahasiswa' => $mahasiswa,
            'dosen' => $dosen,
            'pegawai' => $pegawai,
            'total' => $total,
        ]);
        // return view('kontak.sync', compact(['mahasiswa', 'dosen', 'pegawai', 'kontak']));
    }

    public function syncMahasiswa()
    {
        $mahasiswas = Mahasiswa::doesntHave('kontak')->get();

        $data = [];

        foreach ($mahasiswas as $list) {
            $data[] = [
                'id' => \Illuminate\Support\Str::uuid(),
                'nama' => $list->nama,
                'no_hp' => $list->no_hp,
                'mahasiswa_id' => $list->id,
                'dosen_id' => null,
                'tendik_id' => null,
                'jenis' => 3,
            ];
        }

        Kontak::insert($data);

        return redirect('kontak')->with('success', 'Synchronize Kontak Mahasiswa Berhasil');
    }

    public function syncDosen()
    {
        $dosen = Dosen::doesntHave('kontak')->get();

        $data = [];

        foreach ($dosen as $list) {
            $data[] = [
                'id' => \Illuminate\Support\Str::uuid(),
                'nama' => $list->name,
                'no_hp' => $list->no_hp,
                'mahasiswa_id' => null,
                'dosen_id' => $list->id,
                'tendik_id' => null,
                'jenis' => 1,
            ];
        }

        Kontak::insert($data);

        return redirect('kontak')->with('success', 'Synchronize Kontak Dosen Berhasil');
    }

    public function syncTendik()
    {
        $dosen = Tendik::doesntHave('kontak')->get();

        $data = [];

        foreach ($dosen as $list) {
            $data[] = [
                'id' => \Illuminate\Support\Str::uuid(),
                'nama' => $list->name,
                'no_hp' => $list->no_hp,
                'mahasiswa_id' => null,
                'dosen_id' => null,
                'tendik_id' => $list->id,
                'jenis' => 2,
            ];
        }

        Kontak::insert($data);

        return redirect('kontak')->with('success', 'Synchronize Kontak Pegawai Berhasil');
    }
}
