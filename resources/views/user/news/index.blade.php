@extends('layouts.user')
@section('content')
    <section class="py-0">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">News</h2>
            <div class="row mb-2">
                @foreach ($news as $item)
                    <div class="col-md-12">
                        <div class="row no-gutters border-0 rounded overflow-hidden flex-md-row mb-4 position-relative">
                            <div class="col-auto">
                                <img src="{{ asset('storage/uploads/news/' . $item->gambar) }}" alt=""
                                    class="img-fluid" style="width: 150px; height: 150px;">
                            </div>
                            <div class="col d-flex flex-column position-static">
                                <a href="{{ $item->link_news }}" target="_blank"
                                    class="h4 text-decoration-none text-dark mb-0">{{ $item->title }}</a>
                                <div class="mb-1 text-danger">
                                    {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
