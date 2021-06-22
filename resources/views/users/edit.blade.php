@extends('layouts.admin', ['title', 'Edit User | BPN Kota Langsa'])

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ Route('product.index') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit User</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Edit User</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('user.update', $user->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" autofocus>
                        <p class="text-danger">{{ $errors->first('name') }}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" value="{{ $user->email }}" disabled autofocus>
                    </div>
                    <label for="">Level</label>
                    <div class="form-inline">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="level" id="levelAdmin" value="admin" {{ $user->level == 'admin' ? 'checked' : '' }}>
                            <label class="form-check-label" for="levelAdmin">Admin</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="level" id="levelPegawai" value="pegawai" {{ $user->level == 'pegawai' ? 'checked' : '' }}>
                            <label class="form-check-label" for="levelPegawai">Pegawai</label>
                        </div>
                    </div>
                    <label class="mt-2" for="">Status</label>
                    <div class="form-inline">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="statusAdmin" value="1" {{ $user->status == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="statusAdmin">Aktif</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="statusPegawai" value="0" {{ $user->status == 0 ? 'checked' : '' }}>
                            <label class="form-check-label" for="statusPegawai">Tidak Aktif</label>
                        </div>
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