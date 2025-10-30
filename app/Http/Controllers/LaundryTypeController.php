<?php

namespace App\Http\Controllers;

use App\Models\LaundryType;
use Illuminate\Http\Request;

class LaundryTypeController extends Controller
{
    public function index()
    {
        $laundryTypes = LaundryType::all();
        return view('laundry-types.index', compact('laundryTypes'));
    }

    public function create()
    {
        return view('laundry-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255',
            'satuan' => 'required|string|max:255',
            'harga_per_satuan' => 'required|numeric|min:0',
        ]);

        LaundryType::create($request->all());

        return redirect()->route('laundry-types.index')
            ->with('success', 'Jenis laundry berhasil ditambahkan.');
    }

    public function show(LaundryType $laundryType)
    {
        return view('laundry-types.show', compact('laundryType'));
    }

    public function edit(LaundryType $laundryType)
    {
        return view('laundry-types.edit', compact('laundryType'));
    }

    public function update(Request $request, LaundryType $laundryType)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255',
            'satuan' => 'required|string|max:255',
            'harga_per_satuan' => 'required|numeric|min:0',
        ]);

        $laundryType->update($request->all());

        return redirect()->route('laundry-types.index')
            ->with('success', 'Jenis laundry berhasil diperbarui.');
    }

    public function destroy(LaundryType $laundryType)
    {
        $laundryType->delete();

        return redirect()->route('laundry-types.index')
            ->with('success', 'Jenis laundry berhasil dihapus.');
    }
}