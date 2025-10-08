<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    /**
     * Menampilkan daftar semua item.
     */
    public function index()
    {
        $items = Item::latest()->paginate(10);
        return view('items.index', compact('items'));
    }

    /**
     * Menampilkan form untuk membuat item baru.
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Menyimpan item baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'NamaProduk' => 'required|string|max:255',
            'Jenis' => 'required|string|max:255',
            'Satuan' => 'required|string|max:255',
            'JumlahProduk' => 'required|numeric',
            'Harga' => 'required|integer',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle upload cover
        if ($request->file('cover')) {
            $validatedData['cover'] = $request->file('cover')->store('covers', 'public');
        }
        
        // Buat slug unik
        $validatedData['slug'] = Str::slug($request->NamaProduk, '-') . '-' . time();

        Item::create($validatedData);

        return redirect()->route('items.index')->with('success', 'Item berhasil ditambahkan!');
    }


    /**
     * Menampilkan form untuk mengedit item.
     */
    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    /**
     * Memperbarui item di database.
     */
    public function update(Request $request, Item $item)
    {
        // Validasi input
        $rules = [
            'NamaProduk' => 'required|string|max:255',
            'Jenis' => 'required|string|max:255',
            'Satuan' => 'required|string|max:255',
            'JumlahProduk' => 'required|numeric',
            'Harga' => 'required|integer',
            'cover' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
        
        $validatedData = $request->validate($rules);

        // Handle upload cover baru
        if ($request->file('cover')) {
            // Hapus cover lama jika ada
            if ($item->cover) {
                Storage::disk('public')->delete($item->cover);
            }
            $validatedData['cover'] = $request->file('cover')->store('covers', 'public');
        }

        // Update slug jika nama produk berubah
        if ($request->NamaProduk !== $item->NamaProduk) {
            $validatedData['slug'] = Str::slug($request->NamaProduk, '-') . '-' . time();
        }

        $item->update($validatedData);

        return redirect()->route('items.index')->with('success', 'Item berhasil diperbarui!');
    }

    /**
     * Menghapus item dari database.
     */
    public function destroy(Item $item)
    {
        // Hapus cover dari storage
        if ($item->cover) {
            Storage::disk('public')->delete($item->cover);
        }

        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item berhasil dihapus!');
    }
}