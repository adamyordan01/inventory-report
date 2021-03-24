@extends('layouts.admin', ['title', 'Ubah Produk | BPN Kota Langsa'])

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ Route('category.index') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ubah Kategori Barang</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Ubah Kategori Barang</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('category.update', $category->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Kategori</label>
                        <input type="text" name="category_name" id="" class="form-control" autofocus value="{{ $category->category_name }}">
                        <p class="text-danger">
                            {{ $errors->first('category_name') }}
                        </p>
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