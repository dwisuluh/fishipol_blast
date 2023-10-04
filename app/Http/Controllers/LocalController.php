<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Silvanix\Wablas\File;
use Silvanix\Wablas\Message;
// use Illuminate\Support\Facades\File;

class LocalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('local.index');
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
        // $file = $request->file;
        // $type = File::check_ext($file);
        // $file = request('file');
        // $type = File::extension($file);

        // dd($type);
        $file = $request->file('file');
        $upload = new File();
        $url = $upload->local_upload($file);
        echo $url;
        // $phones = $request->phones;
        // $caption = $request->caption;
        // $file = $request->file('file');
        // $payload = [
        //     'phone' => $phones,
        //     'document' => $file,
        // ];
        // $send = new Message();
        // $mess = $send->single_text($phones,$caption);
        // $test = $send->local_file($file, $phones, $caption);
        // $test = $send->local_document($file, $phones);
        // $test = $send->multiple_document($payload);
        // dd($test);
        // print $test;
        // return redirect('sendwa');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
