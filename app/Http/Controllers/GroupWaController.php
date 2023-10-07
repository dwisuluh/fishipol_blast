<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use App\Models\GroupWa;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class GroupWaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('groupwa.index');
    }

    public function getGroup()
    {
        // $data = GroupWa::with('anggotaGroup')->get();
        $data = GroupWa::all();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('jumlah', function ($group) {
                return $group->anggotaGroup()->count();
            })
            ->addColumn('action', function ($row) {
                $btn = '<a href="javascript:void(0)" class="editData btn btn-primary btn-sm" data-id="' . $row->id . '"><i class="far fa-fw fa-edit" data-toggle="tooltip"
            data-placement="top" title="Edit"></i></a>';
                $btn .= '&nbsp;';
                $btn .= '<a href="' . route("groupWa.show", $row->id) . '" class="showData btn btn-success btn-sm" data-id="' . $row->id . '"><i class="fa fa-fw fa-eye" data-toggle="tooltip"
            data-placement="top" title="Delete"></i></a>';
                $btn .= '&nbsp;';
                $btn .= '<a href="javascript:void(0)" class="deleteData btn btn-danger btn-sm" data-id="' . $row->id . '"><i class="fa fa-fw fa-trash" data-toggle="tooltip"
            data-placement="top" title="Delete"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->toJson();
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
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'scope'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        GroupWa::create([
            'name' => $request->name,
            'scope' => $request->scope,
        ]);

        // $data = Tendik::all();

        return response()->json([
            'success'   => true,
            'message'   => 'Add Data Group Kontak Whatsapp Success!',
            // 'data'      => $data,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(GroupWa $groupWa)
    {
        // dd($groupWa);
        $id = $groupWa->id;
        $kontak = Kontak::with(['anggota_group' => function ($query) use ($id) {
            $query->where('group_wa_id', $id);
        }])
            ->whereDoesntHave('anggota_group', function ($query) use ($id) {
                $query->where('group_wa_id', $id);
            })
            ->get();
        // $kontak = Kontak::leftJoin('anggota_group', 'kontak.id', '=', 'anggota_group.kontak_id')
        //             ->whereNull('anggota_group.id')
        //             ->get();
        return view('groupwa.show', compact(['groupWa', 'kontak']));
    }

    public function getDosen($group_id)
    {
        $data = Kontak::whereNotIn('id', function ($query) use ($group_id) {
            $query->select('kontak_id')
                ->from('anggota_groups')
                ->where('group_wa_id', $group_id);
        })
            ->where('jenis', 1)
            ->where('nama', 'LIKE', '%' . request('q') . '%')
            ->get();

        return response()->json($data);
    }

    public function getPegawai($group_id)
    {
        $data = Kontak::whereNotIn('id', function ($query) use ($group_id) {
            $query->select('kontak_id')
                ->from('anggota_groups')
                ->where('group_wa_id', $group_id);
        })
            ->where('jenis', 2)
            ->where('nama', 'LIKE', '%' . request('q') . '%')
            ->get();

        return response()->json($data);
    }

    public function getMahasiswa($group_id)
    {
        $data = Kontak::whereNotIn('id', function ($query) use ($group_id) {
            $query->select('kontak_id')
                ->from('anggota_groups')
                ->where('group_wa_id', $group_id);
        })
            ->where('jenis', 3)
            ->where('nama', 'LIKE', '%' . request('q') . '%')
            ->get();

        return response()->json($data);
    }

    public function getAnggota($group_id)
    {
        $data = Kontak::whereNotIn('id', function ($query) use ($group_id) {
            $query->select('kontak_id')
                ->from('anggota_groups')
                ->where('group_wa_id', $group_id);
        })
            ->where('jenis', '>', 3)
            ->where('nama', 'LIKE', '%' . request('q') . '%')
            ->get();
        // $query = $request->get('q');
        // $data = Kontak::where('nama', 'LIKE', "%$query%")
        //     ->get();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GroupWa $groupWa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GroupWa $groupWa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GroupWa $groupWa)
    {
        $groupWa->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus.'
        ]);
    }
}
