@extends('layouts.admin', ['title', 'Ubah Produk | BPN Kota Langsa'])

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ Route('product.index') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ubah Produk</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Ubah Produk</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('product.save', $product->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="act" value="edit">
                    
                    <div class="form-group">
                        <label for="">Kode Produk</label>
                        <input type="text" name="product_code" id="" class="form-control" autofocus value="{{ $product->product_code }}">
                        <p class="text-danger">{{ $errors->first('product_code') }}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Produk</label>
                        <input type="text" name="product_name" id="" class="form-control" autofocus value="{{ $product->product_name }}">
                        <p class="text-danger">{{ $errors->first('product_name') }}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Kategori</label>
                        <select name="category_id" id="" class="form-control">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : ''}}>{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Stok</label>
                        <input type="number" name="stock" id="" class="form-control" value="{{ $product->stock }}">
                        <p class="text-danger">{{ $errors->first('stock') }}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Tahun Perolehan</label>
                        <input type="number" name="year" id="" class="form-control" value="{{ $product->stock }}">
                        <p class="text-danger">{{ $errors->first('year') }}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Kondisi</label>
                        <select name="annotation" id="" class="form-control">
                            @can('isAdmin')
                                <option value="Baru">Baru</option>
                            @endcan
                            <option value="Rusak">Rusak</option>
                            <option value="Hilang">Hilang</option>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <button type="submit" class="btn btn-primary float-right">
                            <i class="fas fa-fw fa-paper-plane"></i> Ubah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection