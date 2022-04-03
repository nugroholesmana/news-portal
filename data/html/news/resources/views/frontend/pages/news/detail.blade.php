@extends('frontend.layouts.app')
@section('content')
@include('frontend.components.nav_left')
@include('frontend.components.nav2')
<div class="contentBody" style="margin-left:150px;background:#fff;padding-left:120px;padding-top:20px">
    @include('frontend.components.chat')
    <header>
        <div class="thumbnail-article">
            <img class="d-block" src="{{url('storage/thumbnail/'.$artikel->thumbnail_artikel)}}">
        </div>
        <div class="subtitle-2 mt-4">
            <h1>{{ $artikel->judul_artikel }}</h1>
        </div>
        <p>{{ date('d F Y', strtotime($artikel->updated_at)) }}</p>
    </header>
    <div class="container-fluid mt-4 pb-3">
        <div class="row">
            <div class="col-md-7">
                <div class="articles">
                    <div class="article-item mb-3">
                        <div class="row">
                            <div class="col-md-1 p-0">
                                <div class="divider-line" style="width:100%"></div>
                            </div>
                            <div class="col-md-11 p-0">
                                <div class="pr-3 pl-3">
                                    <p>{!! $artikel->isi_artikel !!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                @include('frontend.components.comment')
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12 mb-4">
                            <h3 class="subtitle-2">GO TO THE NEWS PAGE <img src="{{url('Assets/images/BG 3 - FOOTER.jpg')}}" class="ml-2" width="30px" height="3px"></h3>
                        </div>
                        @for($i=0;$i<2;$i++)
                        <div class="col-md-6 mb-3">
                            <div class="d-flex">
                                <div class="date-publish"><small>20 June 2021 • By Minako</small></div>
                                <div>
                                    <img src="{{url('Assets/Images/asian-family-enjoy-cooking-salad-together-kitchen-room-home_74952-1272.jpeg')}}">
                                    <h3 class="subtitle">Lorem Ipsum Dolor Sed Diam Nonumm</h3>
                                    <div class="d-flex">
                                        <img src="{{url('Assets/images/BG 3 - FOOTER.jpg')}}" class="divider-title" height="1" width="35px">
                                        <p>Lorem ipsum dolor sit amet, adipiscing elit, sed diam nonummy</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endfor
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
