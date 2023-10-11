<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use App\Models\GroupWa;
use Illuminate\Support\Arr;
use App\Models\AnggotaGroup;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AnggotaGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    }

    public function getData($group)
    {
        $jenisMap = [
            1 => 'Dosen',
            2 => 'Tenaga Kependidikan',
            3 => 'Mahasiswa',
            4 => 'Alumni',
            5 => 'Luar Kontak'
        ];
        // $data = Kontak::select('kontaks.*')
        //     ->join('anggota_groups', 'anggota_groups.kontak_id', '=', 'kontaks.id')
        //     ->where('anggota_groups.group_wa_id', $group)->get();

        //query data anggota group
        $data = AnggotaGroup::select('anggota_groups.*', 'kontaks.nama', 'kontaks.no_hp', 'kontaks.jenis')
            ->join('kontaks', 'anggota_groups.kontak_id', '=', 'kontaks.id')
            ->where('anggota_groups.group_wa_id', $group)->get();

        // merubah dari jenis angka menjadi identitas kontak
        $data = $data->map(function ($item) use ($jenisMap) {
            $item->jenis_text = $jenisMap[$item->jenis];
            return $item;
        });
        // $data = AnggotaGroup::where('group_wa_id', $id)->get();
        // $data->load('kontakWa');
        // $data = AnggotaGroup::with('kontakWa')->where('group_wa_id', $id)->get();
        // $data = AnggotaGroup::where('group_wa_id', $id)->get();

        // $data = Kontak::whereIn('kontak_id', $group->anggotaGroup()->select('id')->getQuery())->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="javascript:void(0)" class="deleteData btn btn-danger btn-sm" data-id="' . $row->id . '">
                <i class="fa fa-fw fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>';
                return $btn;
            })->rawColumns(['action'])
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
        $idWa = $request->input('idGroup');

        $dosen = $request->input('dosen');
        $pegawai = $request->input('pegawai');
        $mahasiswa = $request->input('mahasiswa');
        $nonId = $request->input('nonId');

        $kontak = Arr::collapse([$dosen, $pegawai, $mahasiswa, $nonId]);
        $data = [];

        foreach ($kontak as $list) {
            $data[] = [
                'id'    => \Illuminate\Support\Str::uuid(),
                'group_wa_id'   => $idWa,
                'kontak_id'     => $list,
            ];
        }

        AnggotaGroup::insert($data);

        return response()->json(['success' => true, 'message' => 'Data berhasil ditambahkan...']);
    }

    /**
     * Display the specified resource.
     */
    public function show(AnggotaGroup $anggotaGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnggotaGroup $anggotaGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnggotaGroup $anggotaGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnggotaGroup $anggotaGroup)
    {
        // $anggota = AnggotaGroup::findOrFail($anggotaGroup)
        // menghapus nama group
        $anggotaGroup->delete();

        //mengembalikan respon kehalaman awal berupa json
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus.'
        ]);
    }
}
