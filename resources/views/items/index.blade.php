@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Daftar Item Buku</h2>
        <a href="{{ route('items.create') }}" class="btn btn-primary">Tambah Item</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Cover</th>
                        <th>Nama Produk</th>
                        <th>Jenis</th>
                        <th>Satuan</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/' . $item->cover) }}" alt="Cover" width="80">
                            </td>
                            <td>{{ $item->NamaProduk }}</td>
                            <td>{{ $item->Jenis }}</td>
                            <td>{{ $item->Satuan }}</td>
                            <td>{{ $item->JumlahProduk }}</td>
                            <td>Rp {{ number_format($item->Harga, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('items.edit', $item->slug) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('items.destroy', $item->slug) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus item ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada item.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $items->links() }}
            </div>
        </div>
    </div>
@endsection