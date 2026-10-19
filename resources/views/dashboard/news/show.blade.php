@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('View News Entry') }}</h1>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">News Details</h6>
                    <a href="{{ route('news.index') }}" class="btn btn-dark btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="gambar">Gambar:</label>
                        @if ($news->gambar)
                            <img src="{{ asset('storage/uploads/news/' . $news->gambar) }}" alt="News Image" width="100"
                                class="mt-2">
                        @else
                            No Image
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $news->title }}"
                            readonly>
                    </div>

                    <div class="form-group">
                        <label for="link_news">Link News:</label>
                        <input type="text" class="form-control" id="link_news" name="link_news"
                            value="{{ $news->link_news }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
