@extends('frontend.layouts.app')
@section('content')
@include('frontend.components.nav_left')
<div class="contentBody">
    @include('frontend.components.header')
    @include('frontend.components.chat')
    <div class="container-fluid mt-4 mb-3">
        <div class="row mb-3">
            <div class="col-md-12">
                <h3 class="subtitle">THE LATEST <img src="{{url('Assets/images/BG 3 - FOOTER.jpg')}}" width="80px"></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="articles">
                    <div class="row">
                        @foreach($artikels as $row)
                        <div class="col-md-6 mb-3">
                            <div class="d-flex">
                                <div class="date-publish"><small>{{ date('d F Y', strtotime($row->created_at)) }} • By Minako</small></div>
                                <div>
                                    <a href="{{url('detail/'.$row->id)}}">
                                        <img src="{{url('storage/thumbnail/'.$row->thumbnail_artikel)}}">
                                        <h3 class="subtitle">{{ $row->judul_artikel }}</h3>
                                        <div class="d-flex">
                                            <img src="{{url('Assets/images/BG 3 - FOOTER.jpg')}}" class="divider-title" height="1" width="35px">
                                            <p>{{ $row->tag_artikel }}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                @include('frontend.components.trending')
            </div>
        </div>
    </div>
</div>
@endsection
