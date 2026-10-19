@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Garage Details') }}</h1>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-3">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        @if ($garage->gambar)
                            <img src="{{ asset('storage/uploads/garage/' . $garage->gambar) }}" class="card-img-top"
                                alt="Garage Image">
                        @else
                            <img src="{{ asset('storage/uploads/garage/default.jpg') }}" class="card-img-top" alt="No Image">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $garage->title }}</h5>
                            <p class="card-text"><strong>Categories:</strong> {{ ucfirst($garage->categories) }}</p>
                            <p class="card-text"><strong>Description:</strong> {{ $garage->description }}</p>
                            <p>
                                <a href="{{ route('garage.index') }}" class="btn btn-dark btn-sm">
                                    <i class="fas fa-arrow-left"></i> Back to List
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
