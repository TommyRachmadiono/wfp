<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mahasiswa;
use App\User;
use DB;
use Illuminate\Support\Facades\Auth;

class MasterMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if($user['status'] == 'admin')
        {
            
            $mhs = Mahasiswa::all();
            return view('admin.master_mhs', compact('mhs'));
        }
        else
        {
            return view('noaccess');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if($user['status'] == 'admin')
        {
            $mhs = Mahasiswa::all();
            $users = User::all();
            return view('admin.input_mhs', compact('mhs', 'users'));
        }
        else
        {
            return view('noaccess');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if($user['status'] == 'admin')
        {
            $users = new User([ 
              'name' => $request->get('namamhs'),
              'email' => $request->get('email'),
              'username' => $request->get('username'),
              'password' => bcrypt($request->get('password')),
              'status' => 'mahasiswa'
          ]);

            $mhs = new Mahasiswa([ 
              'nrp' => $request->get('nrp'),
              'nama' => $request->get('namamhs'),
              'ips' => $request->get('ips'),
              'ipk' => $request->get('ipk'),
              'maxsks' => $request->get('maxsks'),
              'asdos' => $request->get('optradio'),
              'angkatan' => $request->get('angkatan'),
              'user_id' => $request->get('idmhsbaru'),
          ]);

            $users->save();
            $mhs->save();
            return redirect('master_mahasiswa');
        }
        else
        {
            return view('noaccess');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        if($user['status'] == 'admin')
        {
            $mhs = Mahasiswa::find($id);
            $users = User::find($mhs->user_id);

            return view('admin.edit_mhs', compact('mhs','users','id'));
        }
        else
        {
            return view('noaccess');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if($user['status'] == 'admin')
        {
            $mhs = Mahasiswa::find($id);
            $users = User::find($mhs->user_id);

            $mhs->nama = $request->get('namamhs');
            $mhs->ips = $request->get('ips');
            $mhs->ipk = $request->get('ipk');
            $mhs->maxsks = $request->get('maxsks');
            $mhs->asdos = $request->get('optradio');
            $mhs->angkatan = $request->get('angkatan');

            $users->email = $request->get('email');
            $users->password = bcrypt($request->get('password'));

            $users->save();
            $mhs->save();

            return redirect('master_mahasiswa');
        }
        else
        {
            return view('noaccess');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if($user['status'] == 'admin')
        {
            $mhs = Mahasiswa::find($id);
            $users = User::find($mhs->user_id);

            $mhs->delete();
            $users->delete();

            return redirect('master_mahasiswa');
        }
        else
        {
            return view('noaccess');
        }

    }
}
