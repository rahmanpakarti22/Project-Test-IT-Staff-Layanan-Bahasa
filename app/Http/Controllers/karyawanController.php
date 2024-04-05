<?php

namespace App\Http\Controllers;

use App\Models\karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class karyawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahdata = 10;
        if(strlen($katakunci))
        {
            $data = karyawan::where('nip','like',"%$katakunci%")
            ->orWhere('nama','like',"%$katakunci%")
            ->paginate($jumlahdata);
        }
        else
        {
            $data = karyawan::orderBy('nip','desc')->paginate(15);
        }
        return view('karyawan.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('karyawan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('nip',$request->nip);
        $request->validate([
            'nama' => 'required|string',
            'kode_direktorat' => 'required',
            'tanggal_mulai' => 'required'
        ]);

        $validator = Validator::make($request->all(), [
            'nip' => 'required|string|unique:karyawan,nip|max:12',
            'nama' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'nip' => $request->nip,
            'nama' => $request->nama
        ];

        karyawan::create($data);

        return redirect()->to('home')->with('Berhasil', 'Berhasil menambahkan data karyawan');
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
        $data = karyawan::where('nip', $id)->first();
        return view('karyawan.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [
            'nama' => $request->nama
        ];

        karyawan::where('nip', $id)->update($data);

        return redirect()->to('home')->with('Berhasil', 'Berhasil mengubah data karyawan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        karyawan::where('nip', $id)->delete();
        return redirect()->to('home')->with('Berhasil', 'Berhasil mengubah data karyawan');
    }
}
