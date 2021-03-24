@extends('layouts.admin', ['title', 'Tambah Produk | Lara-Ecommerce'])

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('item.index') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Produk</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Tambah Barang</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('item.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="barang">Nama Barang</label>
                        <input type="text" class="form-control" id="barang" name="item" placeholder="Masukkan nama barang" autofocus value="{{ old('item') }}">
                        <p class="text-danger">{{ $errors->first('item') }}</p>
                    </div>
                    <div class="form-group">
                        <label for="jenis">Jenis</label>
                        <select name="type" id="jenis" class="form-control">
                            <option value="Perabot">Perabot</option>
                            <option value="Mesin">Mesin</option>
                            <option value="ATK">ATK</option>
                        </select>
                        <p class="text-danger">{{ $errors->first('type') }}</p>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="stok">Stok</label>
                                <input type="number" class="form-control" id="stok" name="stock" value="{{ old('stock') }}">
                                <p class="text-danger">{{ $errors->first('stock') }}</p>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="condition">Kondisi</label>
                                <select name="condition" id="condition" class="form-control">
                                    <option value="1">Baik</option>
                                    <option value="2">Rusak</option>
                                    <option value="3">Hilang</option>
                                </select>
                                <p class="text-danger">{{ $errors->first('condition') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <button type="submit" class="btn btn-primary float-right">
                            <i class="fas fa-fw fa-paper-plane"></i> Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection