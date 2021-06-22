@extends('layouts.admin', ['title', 'Barang | BPN Kota Langsa'])

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Home</a></li>
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
                        @can('isAdmin')    
                            <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-plus"></i> Add
                            </button>
                        @endcan
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
                            <form action="" method="GET" class="form-inline my-2 my-lg-0 float-right">
                                <input class="form-control mr-sm-2" type="text" name="q" value="" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Kode Produk</td>
                                    <td>Nama Produk</td>
                                    <td>Kategori</td>
                                    <td>Stok</td>
                                    <td>Di input pada</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $product->product_code }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->category->category_name }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>{{ $product->when }}</td>
                                        <td>
                                            <form action="{{ route('product.destroy', $product->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-circle btn-sm btn-warning">
                                                    <i class="fas fa-fw fa-pencil-alt"></i>
                                                </a>
                                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-circle btn-sm btn-info">
                                                    <i class="far fa-fw fa-eye"></i>
                                                </a>
                                                <button type="submit" class="btn btn-circle btn-sm btn-danger" onclick="return confirm('Apakah ingin menghapus data tersebut?');">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $products->links() }}
                    {{-- {{ $items->appends($request)->links() }} --}}
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="{{ route('product.store') }}" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="act" value="add">
                        @csrf
                        <div class="form-group">
                            <label for="">Kode Produk</label>
                            <input type="text" name="product_code" id="" class="form-control" autofocus>
                            <p class="text-danger">{{ $errors->first('product_code') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Produk</label>
                            <input type="text" name="product_name" id="" class="form-control" autofocus>
                            <p class="text-danger">{{ $errors->first('product_name') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Kategori</label>
                            <select name="category_id" id="" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Stok</label>
                            <input type="number" name="stock" id="" class="form-control">
                            <p class="text-danger">{{ $errors->first('stock') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="when">Tanggal Input</label>
                            <input type="text" name="when" id="datepicker" class="form-control">
                            <p class="text-danger">{{ $errors->first('when') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Tahun Perolehan</label>
                            <input type="number" name="year" id="" class="form-control">
                            <p class="text-danger">{{ $errors->first('year') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Kondisi</label>
                            <select name="annotation" id="" class="form-control">
                                <option value="Baru">Baru</option>
                                <option value="Rusak">Rusak</option>
                                <option value="Hilang">Hilang</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#datepicker').datepicker({ uiLibrary: 'bootstrap4', format: 'yyyy-mm-dd' });
    </script>
@endsection