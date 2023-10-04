<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use App\Models\SendWa;
use App\Models\GroupWa;
use App\Models\Mahasiswa;
use App\Models\Recipient;
use Illuminate\View\View;
use Silvanix\Wablas\File;
use Silvanix\Wablas\Check;
use App\Traits\WablasTrait;
use Illuminate\Support\Arr;
use App\Models\AnggotaGroup;
use Illuminate\Http\Request;
use Silvanix\Wablas\Message;
use Illuminate\Support\Facades\Auth;

class SendWaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $check = new Check();
        $phones = '082326060821';
        $phone = $check->phone($phones);
        $phone = $phone['data'][0];

        // dd($phone);
        // $sendwa = SendWa::latest('created_at')->get();
        $sendwa = SendWa::withCount('recipient')->latest('created_at')->get();
        return view('send.index', compact(['sendwa', 'phone']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $mahasiswas = Mahasiswa::join('program_studis', 'mahasiswas.kode_prodi', '=', 'program_studis.kode')
        //     ->get(['mahasiswas.*', 'program_studis.nama as nama_prodi', 'program_studis.jenjang']);
        $mahasiswas = Kontak::with(['mahasiswa.prodi'])->where('jenis', 3)->get();
        $kontaks = Kontak::all();
        $groups = GroupWa::all();
        // dd($mahasiswas);
        return view('send.create', compact(['mahasiswas', 'kontaks', 'groups']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'perihal' => ['required'],
            'message' => ['required']
        ];

        if ($request->cdosen === 'cdosen') {
            $rules['dosen'] = ['required', 'array', 'min:1'];
            $rules['dosen.*'] = ['required', 'string'];
        }

        if ($request->ctendik === 'ctendik') {
            $rules['tendik'] = ['required', 'array', 'min:1'];
            $rules['tendik.*'] = ['required', 'string'];
        }

        if ($request->cmahasiswa === 'cmahasiswa') {
            $rules['mahasiswa'] = ['required', 'array', 'min:1'];
            $rules['mahasiswa.*'] = ['required', 'string'];
        }

        if ($request->cgroup === 'cgroup') {
            $rules['group'] = ['required', 'array', 'min:1'];
            $rules['group.*'] = ['required', 'string'];
        }

        if ($request->cheader === 'cheader') {
            $rules['header'] = ['required'];
        }

        if ($request->cfile === 'cdoc') {
            $rules['doc'] = ['required'];
        }

        if ($request->cfile === 'cfile') {
            $rules['file'] = ['required', 'file', 'max:2048'];
        }

        $request->validate($rules);

        $request_data = [];
        $header = request('header');
        $send = new Message();

        // dd($idAnggota);
        $group = null;
        if ($request->cgroup === 'cgroup') {
            $group = AnggotaGroup::whereIn('group_wa_id', $request->group)->pluck('kontak_id');
        }
        // $group = AnggotaGroup::where('group_wa_id', $request->group)->pluck('kontak_id');
        // dd($group);
        $penerima = Arr::collapse([request('dosen'), request('tendik'), request('mahasiswa'), request(['no_hp']), $group]);
        $penerimas = Kontak::find($penerima);

        // dd($penerimas);
        $message = request('message');
        // foreach($request->no_hp as $list){

        if ($request->cheader === 'cheader' && $request->cdoc === 'cdoc') {
            foreach ($penerimas as $list) {
                $data['phone'] = $list->no_hp;
                $data['message'] = $header . '<br>*' . $list->nama . '*<br>' . $message;
                $data['document'] = request('doc');
                $data['secret'] = false;
                $data['retry'] = false;
                $data['isGroup'] = false;
                array_push($request_data, $data);
            }

            WablasTrait::sendText($request_data);
            WablasTrait::sendFile($request_data);
            //cek kondisi selanjutnya
        } elseif ($request->cheader === 'cheader' && $request->cfile === 'cfile') {

            $file = $request->file;
            $upload = new File;
            $url = $upload->local_upload($file);
            $check = File::check_ext($file);

            // dd($check);

            if ($check == 'document') {

                foreach ($penerimas as $list) {
                    // $send->single_text($list->no_hp, $header . "<br>*" . $list->nama . "*<br>" . $message);
                    // $send->local_file($file, $list->no_hp, $header . "<br>*" . $list->nama . "*<br>" . $message);
                    $data['phone'] = $list->no_hp;
                    $data['caption'] = $header . '<br>*' . $list->nama . '*<br>' . $message;
                    $data['document'] = $url;
                    $data['secret'] = false;
                    $data['retry'] = false;
                    $data['isGroup'] = false;
                    array_push($request_data, $data);
                }
                // $send->multiple_text($request_data);

                $send->multiple_document($request_data);
            } else if ($check == 'image') {

                foreach ($penerimas as $list) {
                    // $send->single_text($list->no_hp, $header . "<br>*" . $list->nama . "*<br>" . $message);
                    // $send->local_file($file, $list->no_hp, $header . "<br>*" . $list->nama . "*<br>" . $message);
                    $data['phone'] = $list->no_hp;
                    $data['caption'] = $header . '<br>*' . $list->nama . '*<br>' . $message;
                    $data['image'] = $url;
                    $data['secret'] = false;
                    $data['retry'] = false;
                    $data['isGroup'] = false;
                    array_push($request_data, $data);
                }
                // $send->multiple_text($request_data);

                $send->multiple_image($request_data);
            }
            //cek kondisi selanjutnya
        } elseif ($request->cheader === 'cheader' && $request->cdoc === null) {
            foreach ($penerimas as $list) {
                $data['phone'] = $list->no_hp;
                $data['message'] = $header . '<br>*' . $list->nama . '*<br>' . $message;
                // $data['document'] = request('doc');
                $data['secret'] = false;
                $data['retry'] = false;
                $data['isGroup'] = false;
                array_push($request_data, $data);
            }
            // dd($request_data);
            $send->multiple_text($request_data);
            // WablasTrait::sendText($request_data);
        } elseif ($request->cfile === 'cfile' && $request->cheader === null) {

            // foreach ($penerimas as $list) {
            //     $data['phone'] = $list->no_hp;
            //     // $data['message'] = $message;
            //     $data['document'] = request('doc');
            //     $data['secret'] = false;
            //     $data['retry'] = false;
            //     $data['isGroup'] = false;
            //     array_push($request_data, $data);
            // }
            // $sendMessage = [
            //     'phone' => '08122827755',
            //     'message' => $message,
            //     'document' => request('doc'),
            //     'secret' => false,
            //     'retry' => false,
            //     'isGroup' => false,

            // ];

            $file = $request->file;

            $upload = new File();
            $url = $upload->local_upload($file);
            // echo $url;

            $check = File::check_ext($file);

            // dd($check);
            if ($check == 'image' || $check == 'video') {

                foreach ($penerimas as $list) {
                    // for ($i = 0; $i < 2; $i++) {

                    // $send->single_text($list->no_hp, $message);
                    $send->local_file($file, $list->no_hp, $message);
                    // }
                }
                // }
            } else {

                foreach ($penerimas as $list) {
                    // $send->single_text($list->no_hp, $message);
                    // $send->local_file($file, $list->no_hp, $message);
                    $data['phone'] = $list->no_hp;
                    $data['caption'] = $message;
                    $data['document'] = $url;
                    // $data['document'] = request('doc');
                    $data['secret'] = false;
                    $data['retry'] = false;
                    $data['isGroup'] = false;
                    array_push($request_data, $data);
                }

                // $send->multiple_text($request_data);
                $send->multiple_document($request_data);
            }

            // dd($sendMessage);
            // WablasTrait::sendText($sendMessage);
            // WablasTrait::sendFile($sendMessage);
        } else {

            // for ($i = 0; $i < 10; $i++) {

            // $send = new Message();

            // $send->single_text('08122827755', $message);

            foreach ($penerimas as $list) {
                $data['phone'] = $list->no_hp;
                $data['message'] = $message;
                // $data['document'] = request('doc');
                $data['secret'] = false;
                $data['retry'] = false;
                $data['isGroup'] = false;
                array_push($request_data, $data);
            }

            // $sendMessage = [
            //     'phone' => '08122827755',
            //     'message' => $message,
            //     // $data['document'] = request('doc');
            //     'secret' => false,
            //     'retry' => false,
            //     'isGroup' => false,

            // ];

            // dd($request_data);

            $send->multiple_text($request_data);

            // WablasTrait::sendText($request_data);

            // }
        }

        $file = 'N';
        if ($request->cdoc === 'cdoc') {
            $file = 'Y';
        }

        $user = Auth::user();

        // dd($user);

        $insert = SendWa::create([
            'user_id' => $user->id,
            'messagge' => $message,
            'about' => $request->perihal,
            'file' => $file,
            'sender'    => $user->name,
            'sender_email' => $user->email,
        ]);

        // dd($idMessage);
        $recepient = [];
        foreach ($penerimas as $list) {
            $recepient[] = [
                'id' => \Illuminate\Support\Str::uuid(),
                'send_wa_id' => $insert->id,
                'kontak_id' => $list->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Recipient::insert($recepient);
        // foreach ($penerimas as $list) {
        //     // $data['phone'] = $list['subject'];
        //     $data['phone'] = $list->no_hp;
        //     $data['message'] = $header . '<br>*' . $list->nama . '*<br>' . $message;
        //     $data['document'] = request('doc');
        //     $data['secret'] = false;
        //     $data['retry'] = false;
        //     $data['isGroup'] = false;
        //     array_push($request_data, $data);
        // }
        // // dd($request_data);
        return redirect('sendWa');

        // WablasTrait::sendText($request_data);
        // WablasTrait::sendFile($request_data);
        // return redirect()->back();
    }
    /**
     * Display the specified resource.
     */
    public function show(SendWa $sendWa)
    {
        // dd($sendWa);
        $jenisMap = [
            1 => 'Dosen',
            2 => 'Tenaga Kependidikan',
            3 => 'Mahasiswa',
            4 => 'Alumni',
            5 => 'Luar Kontak'
        ];

        $recepient = Recipient::with(['kontak' => function ($query) {
            $query->orderBy('nama', 'asc');
        }])->where('send_wa_id', $sendWa->id)->get();

        $recepient = $recepient->map(function ($item) use ($jenisMap) {
            $item->jenis_text = $jenisMap[$item->kontak->jenis];
            return $item;
        });

        // $recepient->load('kontak');
        // dd($recepient);

        return view('send.show', compact(['recepient', 'sendWa']));
    }

    public function getRecepient($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SendWa $sendWa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SendWa $sendWa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SendWa $sendWa)
    {
        //
    }
}
