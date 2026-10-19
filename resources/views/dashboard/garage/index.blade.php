@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Garage') }}</h1>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger border-left-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <span class="m-0 h5 font-weight-bold text-dark">Garage</span>
                    <a href="{{ route('garage.create') }}" class="btn btn-dark btn-sm">
                        <i class="fas fa-plus-square"></i> Add New
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Title</th>
                                    <th>Categories</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($garages as $garage)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($garage->gambar)
                                                <img src="{{ asset('storage/uploads/garage/' . $garage->gambar) }}"
                                                    alt="Garage Image" width="100">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>{{ $garage->title }}</td>
                                        <td>{{ ucfirst($garage->categories) }}</td>
                                        <td>{!! Str::limit($garage->description, 50) !!}</td>
                                        <td>
                                            <a href="{{ route('garage.show', $garage->id) }}" class="btn btn-info btn-sm"><i
                                                    class="fas fa-eye"></i></a>
                                            <a href="{{ route('garage.edit', $garage->id) }}"
                                                class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('garage.destroy', $garage->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this entry?')"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                            <a href="{{ route('garage.images', $garage->id) }}"
                                                class="btn btn-primary btn-sm"><i class="fas fa-images"></i> Add Images</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No data available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
