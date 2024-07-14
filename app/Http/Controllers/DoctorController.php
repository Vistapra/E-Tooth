<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     * Menampilkan daftar dokter.
     */
    public function index()
    {
        // Mengambil daftar dokter dan mengurutkannya berdasarkan nama
        $doctor = Doctor::orderBy('name', 'asc')->get();

        return view('admin.doctor.index', [
            'doctor' => $doctor
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * Menampilkan form untuk membuat dokter baru.
     */
    public function create()
    {
        return view('admin.doctor.create');
    }

    /**
     * Store a newly created resource in storage.
     * Menyimpan dokter baru ke dalam basis data.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string',
            'spesialis' => 'required|string|max:255',
            'photo' => 'required|image|mimetypes:image/*|max:2048'

        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'spesialis.required' => 'Spesialis wajib diisi.',
            'spesialis.string' => 'Spesialis harus berupa teks.',
            'spesialis.max' => 'Spesialis tidak boleh lebih dari 255 karakter.',
            'photo.required' => 'Foto wajib diunggah.',
            'photo.image' => 'Foto harus berupa gambar.',
            'photo.mimes' => 'Foto harus berformat jpeg, png, atau jpg.',
            'photo.max' => 'Ukuran foto tidak boleh lebih dari 2MB.',
        ]);

        // Memulai transaksi database
        DB::beginTransaction();

        try {
            // Cek apakah file foto ada, jika ada simpan di storage
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('doctor_photos', 'public');
                $validated['photo'] = $photoPath;
            }

            // Membuat slug dari nama dokter
            $validated['slug'] = Str::slug($request->name);

            // Membuat dokter baru dengan data yang telah divalidasi
            $dokter = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt('e-tooth'),
            ]);
            $dokter->assignRole('doctor');
            $validated['user_id'] = $dokter->id;
            $newDoctor = Doctor::create($validated);


            // Komit transaksi jika berhasil
            DB::commit();

            // Redirect ke halaman index dokter admin dengan pesan sukses
            return redirect()->route('admin.doctor.index')->with('success', 'Dokter telah berhasil dibuat.');
        } catch (\Exception $e) {
            // Rollback transaksi jika ada kesalahan
            DB::rollBack();
            // Lempar kesalahan validasi dengan pesan kesalahan sistem
            $error = ValidationException::withMessages([
                'system_error' => ['System error: ' . $e->getMessage()],
            ]);
            throw $error;
        }
    }

    /**
     * Display the specified resource.
     * Menampilkan detail dokter tertentu.
     */
    public function show(Doctor $doctor)
    {
        return view('admin.doctor.show', [
            'doctor' => $doctor
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * Menampilkan form untuk mengedit dokter tertentu.
     */
    public function edit(Doctor $doctor)
    {
        return view('admin.doctor.edit', [
            'doctor' => $doctor
        ]);
    }

    /**
     * Update the specified resource in storage.
     * Mengupdate data dokter tertentu.
     */
    public function update(Request $request, Doctor $doctor)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'spesialis' => 'sometimes|string|max:255'
        ]);

        // Memulai transaksi database
        DB::beginTransaction();

        try {
            // Cek apakah file foto ada, jika ada simpan di storage
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('doctor_photos', 'public');
                $validated['photo'] = $photoPath;
            }

            // Membuat slug dari nama dokter
            $validated['slug'] = Str::slug($request->name);

            $doctor->update($validated);

            // Komit transaksi jika berhasil
            DB::commit();

            // Redirect ke halaman index dokter admin dengan pesan sukses
            return redirect()->route('admin.doctor.index')->with('success', 'Dokter telah berhasil diperbarui.');
        } catch (\Exception $e) {
            // Rollback transaksi jika ada kesalahan
            DB::rollBack();
            // Lempar kesalahan validasi dengan pesan kesalahan sistem
            $error = ValidationException::withMessages([
                'system_error' => ['System error: ' . $e->getMessage()],
            ]);
            throw $error;
        }
    }

    /**
     * Remove the specified resource from storage.
     * Menghapus dokter tertentu dari basis data.
     */
    public function destroy(Doctor $doctor)
    {
        try {
            DB::beginTransaction();

            $doctor->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Dokter berhasil dihapus.');
        } catch (\Exception $e) {
            // Rollback transaksi jika ada kesalahan
            DB::rollBack();
            // Lempar kesalahan validasi dengan pesan kesalahan sistem
            $error = ValidationException::withMessages([
                'system_error' => ['System error: ' . $e->getMessage()],
            ]);
            throw $error;
        }
    }
}
