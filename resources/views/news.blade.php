@extends('layouts.master')

@section('title', env('APP_NAME') .' - Blog thời trang')

@section('menu')
    @include('components.menu')
@endsection

@section('content')
    <div class="header__banner">
        <div class="header__banner-content">
            <h2>{{ trans('view.news.blog_fashion') }}</h2>
            <div class="header__banner-sortlink">
                <a href={{route('home')}}>{{ trans('view.home') }}</a>
                <span>
                    <i class="fal fa-angle-right"></i>
                </span>
                <a href={{route('wishlist')}}>{{ trans('view.news.blog_fashion') }}</a>
            </div>
        </div>
    </div>

    <div class="contain-news">
        <div class="pos_title mt-3 mb-4">
            <h2 class="newbie">@lang('view.news.newest')</h2>
        </div>

        <div class="news">
            @foreach($news as $new)
                <a href="{{ route('news-show', $new->slug) }}" class="news-contain">
                    <div class="news-img">
                        <img src="{{ asset('images') }}/{{ $new->image }}" alt="">
                    </div>
                    <div class="news-content">
                        <h2 title="{{ $new->title }}" class="news-title">{{ $new->title }}</h2>
                        <p class="news-time">{{ Carbon\Carbon::parse($new->created_at)->diffForHumans() }}</p>
                        <p class="news-description">{{ $new->description }}</p>
                    </div>
                </a>
            @endforeach

            {{ $news->links() }}
        </div>

    </div>  

    @include('components.footer')
@endsection