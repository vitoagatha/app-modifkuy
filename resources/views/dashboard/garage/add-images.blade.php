@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">Add Images for {{ $garage->title }}</h1>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <span class="m-0 font-weight-bold text-dark">Garage Images</span>
                    <div>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addImageModal">
                            <i class="fas fa-plus"></i> Add Image
                        </button>
                        <a href="{{ route('garage.index') }}" class="btn btn-dark btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Image List -->
                    <div class="row" id="imageList">
                        @foreach ($garage->garageImages as $image)
                            <div class="col-lg-3 mb-4">
                                <div class="card shadow">
                                    <img src="{{ asset('storage/uploads/garage/' . $image->image_path) }}"
                                        class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                data-target="#editImageModal{{ $image->id }}">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#deleteImageModal{{ $image->id }}">
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Image Modal -->
                            <div class="modal fade" id="editImageModal{{ $image->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="editImageModalLabel{{ $image->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editImageModalLabel{{ $image->id }}">Edit Image
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('garage.images.update', ['id' => $image->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="image{{ $image->id }}">Image</label>
                                                    <input type="file" class="form-control"
                                                        id="image{{ $image->id }}" name="image">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Image Modal -->
                            <div class="modal fade" id="deleteImageModal{{ $image->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="deleteImageModalLabel{{ $image->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteImageModalLabel{{ $image->id }}">Delete
                                                Image</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('garage.images.delete', ['id' => $image->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body">
                                                Are you sure you want to delete this image?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Image Modal -->
    <div class="modal fade" id="addImageModal" tabindex="-1" role="dialog" aria-labelledby="addImageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addImageModalLabel">Add Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('garage.images.store', ['garage_id' => $garage->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Image</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
