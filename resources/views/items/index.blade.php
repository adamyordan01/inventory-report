@extends('layouts.admin', ['title', 'Barang | BPN Langsa'])

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('item.index') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Barang</li>
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
                            <h5 class="card-title">List Barang</h5>
                        </div>
                        {{-- <div class="col-md-6">
                            <a href="{{ route('item.create') }}" class="btn btn-primary btn-sm float-right">
                                <i class="fas fa-plus"></i> Tambah
                            </a>
                        </div> --}}
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="row">
                        <div class="col-md">
                            <form action="{{ route('item.index') }}" method="GET" class="form-inline my-2 my-lg-0 float-right">
                                <input class="form-control mr-sm-2" type="text" name="q" value="{{ request()->q }}" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Barang</td>
                                    <td>Jenis</td>
                                    <td>Stok</td>
                                    <td>Kondisi</td>
                                    <td>Di input pada</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $item->item }}
                                    </td>
                                    <td>
                                        {{ $item->type }}
                                    </td>
                                    <td>
                                        {{ $item->stock }}
                                    </td>
                                    <td>
                                        @if ($item->condition == 1)
                                            <span class="badge badge-success">Baik</span>
                                        @elseif ($item->condition == 2)
                                            <span class="badge badge-danger">Rusak</span>
                                        @elseif ($item->condition == 3)
                                            <span class="badge badge-dark">Hilang</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $item->created_at->format('d-m-Y') }}
                                    </td>
                                    <td>
                                        <form action="{{ route('item.destroy', $item->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <a href="{{ route('item.edit', $item->id) }}" class="btn btn-circle btn-sm btn-warning">
                                                <i class="fas fa-fw fa-pencil-alt"></i>
                                            </a>
                                            <button type="submit" class="btn btn-circle btn-sm btn-danger" onclick="return confirm('Apakah ingin menghapus data tersebut?');">
                                                <i class="far fa-fw fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Data masih kosong.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $items->appends($request)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection