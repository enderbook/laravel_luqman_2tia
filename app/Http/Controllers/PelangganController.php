<?php
namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;


class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataPelanggan'] = Pelanggan::all();
        return view('admin.pelanggan.index', $data);
    }

    public function detail()
    {
        $data['dataPelanggan'] = Pelanggan::all();
        return view('admin.pelanggan.detail', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $data = $request->only([
            'first_name',
            'last_name',
            'birthday',
            'gender',
            'email',
            'phone' ,
            'foto_profil',
        ]);

        if ($request->hasFile('foto_profil')) {
            $data['foto_profil'] = $request->file('foto_profil')
                ->store('foto-profil', 'public');
        }

        Pelanggan::create($data);

        return redirect()
            ->route('pelanggan.index')
            ->with('success', 'Penambahan Data Berhasil!');
    }

    public function cvOnline($id)
    {
        $dataPelanggan = \App\Models\Pelanggan::findOrFail($id);

        return view('admin.pelanggan.detail', compact('dataPelanggan'));
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $data['dataPelanggan'] = Pelanggan::findOrFail($id);
        return view('admin.pelanggan.edit', $data);
    }


    public function update(Request $request, string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $data = $request->only([
            'first_name',
            'last_name',
            'birthday',
            'gender',
            'email',
            'phone' ,
            'foto_profil',
        ]);

        if ($request->hasFile('foto_profil')) {
            // Hapus foto lama jika ada
            if ($pelanggan->foto_profil) {
                Storage::disk('public')->delete($pelanggan->foto_profil);
            }

            $data['foto_profil'] = $request->file('foto_profil')
                ->store('foto-profil', 'public');
        }

        $pelanggan->update($data);

        return redirect()
            ->route('pelanggan.index')
            ->with('success', 'Perubahan Data Berhasil!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $pelanggan->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Data berhasil dihapus');
    }

}
