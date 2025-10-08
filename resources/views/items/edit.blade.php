@extends('layouts.app')

@section('content')
    <h2>Edit Item: {{ $item->NamaProduk }}</h2>

    <div class="card mt-4">
        <div class="card-body">
            <form action="{{ route('items.update', $item->slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="NamaProduk" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control @error('NamaProduk') is-invalid @enderror" id="NamaProduk" name="NamaProduk" value="{{ old('NamaProduk', $item->NamaProduk) }}">
                    @error('NamaProduk')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                 <div class="mb-3">
                    <label for="Jenis" class="form-label">Jenis</label>
                    <input type="text" class="form-control @error('Jenis') is-invalid @enderror" id="Jenis" name="Jenis" value="{{ old('Jenis', $item->Jenis) }}">
                    @error('Jenis')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label for="Satuan" class="form-label">Satuan</label>
                    <input type="text" class="form-control @error('Satuan') is-invalid @enderror" id="Satuan" name="Satuan" value="{{ old('Satuan', $item->Satuan) }}">
                    @error('Satuan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label for="JumlahProduk" class="form-label">Jumlah Produk</label>
                    <input type="number" class="form-control @error('JumlahProduk') is-invalid @enderror" id="JumlahProduk" name="JumlahProduk" value="{{ old('JumlahProduk', $item->JumlahProduk) }}">
                    @error('JumlahProduk')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label for="Harga" class="form-label">Harga</label>
                    <input type="number" class="form-control @error('Harga') is-invalid @enderror" id="Harga" name="Harga" value="{{ old('Harga', $item->Harga) }}">
                    @error('Harga')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label for="cover" class="form-label">Cover</label>
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $item->cover) }}" alt="Current Cover" width="100">
                    </div>
                    <input class="form-control @error('cover') is-invalid @enderror" type="file" id="cover" name="cover">
                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah cover.</small>
                    @error('cover')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <button type="submit" class="btn btn-primary">Perbarui</button>
                <a href="{{ route('items.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection