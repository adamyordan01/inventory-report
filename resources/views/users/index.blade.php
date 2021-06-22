@extends('layouts.admin', ['title', 'Daftar User | BPN Langsa'])

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Log Stock</li>
    </ol>
</nav>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-6">
                            <h5 class="card-title">Daftar User</h5>
                        </div>
                        {{-- <div class="col-md-6">
                            <a href="{{ route('item.create') }}" class="btn btn-primary btn-sm float-right">
                                <i class="fas fa-plus"></i> Tambah
                            </a>
                        </div> --}}
                        {{-- <a href="{{ route('log.print') }}" target="_blank" class="btn btn-sm btn-primary float-right">
                            <i class="fas fa-fw fa-print"></i> Cetak
                        </a> --}}
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <a href="{{ route('user.create') }}" class="btn btn-primary"> <b>+</b> Tambah User</a>

                    <div class="table-responsive mt-4">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>E-Mail</th>
                                    <th>Level</th>
                                    <th>Status</th>
                                    <th>Di input pada</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $user->name }}
                                        </td>
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                        <td>
                                            {{ $user->level }}
                                        </td>
                                        <td>
                                            @if ($user->status == 1)
                                                <span class="badge badge-primary">Aktif</span>
                                            @elseif ($user->status == 0)
                                                <span class="badge badge-dark">Tidak Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $user->created_at->format('d-m-Y') }}
                                        </td>
                                        <td>
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-circle btn-sm btn-warning">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                @if ($user->level != "admin")
                                                    <button type="submit" class="btn btn-circle btn-sm btn-danger" onclick="return confirm('Apakah ingin menghapus data tersebut?');">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $users->links() }}
                    {{-- {{ $items->appends($request)->links() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection