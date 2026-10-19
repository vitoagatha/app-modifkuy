@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Edit Garage Entry') }}</h1>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Edit Garage Entry</h6>
                    <a href="{{ route('garage.index') }}" class="btn btn-dark btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('garage.update', $garage->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="gambar">Current Image:</label>
                            <br>
                            @if ($garage->gambar)
                                <img src="{{ asset('storage/uploads/garage/' . $garage->gambar) }}" alt="Garage Image"
                                    width="300">
                                <br><br>
                                <label for="gambar">Change Image:</label>
                            @else
                                <span>No Image</span>
                            @endif
                            <input type="file" class="form-control" id="gambar" name="gambar">
                        </div>

                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{ old('title', $garage->title) }}">
                        </div>

                        <div class="form-group">
                            <label for="categories">Categories:</label>
                            <select class="form-control" id="categories" name="categories">
                                <option value="matic" {{ $garage->categories == 'matic' ? 'selected' : '' }}>Matic</option>
                                <option value="manual" {{ $garage->categories == 'manual' ? 'selected' : '' }}>Manual
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $garage->description) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-dark">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
