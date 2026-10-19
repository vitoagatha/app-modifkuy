@extends('layouts.user')
@section('content')
    <section class="py-0">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6">
                    <img class="card-img-top mb-5 mb-md-0" src="{{ asset('storage/uploads/garage/' . $garage->gambar) }}"
                        alt="..." />
                </div>
                <div class="col-md-6">
                    <h1 class="display-5 fw-bolder">{{ $garage->title }}</h1>
                    <div class="lead">
                        <div class="h3 underline-offset-auto"><u>Descriptions</u></div>
                        {!! $garage->description !!}
                    </div>
                    <div class="d-flex mt-3">
                        <form action="{{ route('motorcycle.like', $garage->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-dark flex-shrink-0 fw-bold" type="submit" id="likes">
                                <i class="bi bi-heart-fill"></i>
                                <span>{{ $garage->likes }}</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                @foreach ($garage->garageImages as $image)
                    <div class="col-lg-3 mb-4">
                        <div class="card shadow">
                            <img src="{{ asset('storage/uploads/garage/' . $image->image_path) }}" class="card-img-top"
                                alt="...">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Most Popular Motorcycle</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-start">
                @foreach ($garages as $row)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <div class="badge bg-dark text-white position-absolute text-capitalize"
                                style="top: 0.5rem; right: 0.5rem">
                                {{ $row->categories }}
                            </div>
                            <img class="card-img-top" src="{{ asset('storage/uploads/garage/' . $row->gambar) }}"
                                alt="Garage Image">
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h5 class="fw-bolder">{{ $row->title }}</h5>
                                </div>
                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto"
                                        href="{{ route('motorcycle.show', $row->id) }}">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
