<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataUser'] = User::all();
		return view('admin.user.index',$data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(){
		return view('admin.user.create');
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Terapkan validasi sesuai Langkah 2
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed', // 'confirmed' memvalidasi kecocokan dengan password_confirmation
        ]);

        // 2. Ambil data yang sudah lolos validasi atau mapping manual
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        User::create($data);

        // 3. Flash message sukses (sudah sesuai)
        return redirect()->route('user.index')->with('success', 'Penambahan Data Berhasil!');
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
          $data['dataUser'] = User::findOrFail($id);
        return view('admin.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        // 1. Terapkan validasi untuk Edit/Update
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email,' . $user->id, // Abaikan email user ini sendiri agar tidak error 'already taken'
            'password' => 'nullable|string|min:8|confirmed', // 'nullable' karena password boleh dikosongkan saat edit
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        // 2. Logika kondisional: Hanya update password jika kolom diisi oleh user
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // 3. Flash message sukses (sudah sesuai)
        return redirect()->route('user.index')->with('success', 'Perubahan Data Berhasil!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    $user = User::findOrFail($id);

    $user->delete();
    return redirect()->route('user.index')->with('success', 'Data berhasil dihapus');
        }

    }
