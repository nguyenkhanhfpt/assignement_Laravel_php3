@extends('layouts.master')

@section('meta')
<meta name="description" content="{{ $news->description }}" />
<meta property="og:title" content="{{ env('APP_NAME') .' - '. $news->title}}" />
<meta property="og:description" content="{{ $news->description }}" />
<meta itemprop="image" content="{{ asset('images') }}/{{ $news->image }}"/>
@endsection

@section('title', env('APP_NAME') .' - '. $news->title)

@section('menu')
    @include('components.menu')
@endsection

@section('content')
    <div class="contain-news">
        <div class="viewNews">
            <div class="viewNews-img">
                <img src="{{ asset('images') }}/{{ $news->image }}" alt="">
            </div>
            <div class="viewNews-content">
                <h2 class="viewNews-content__title">{{ $news->title }}</h2>

                <div class="viewNews-content__time">
                    <p class="viewNews-content__name">{{ $member->name_member ?? 'Admin' }}</p>
                    <p title="{{ $news->created_at }}" class="viewNews-content__diffTime">
                        {{ Carbon\Carbon::parse($news->created_at)->diffForHumans() }}
                    </p>
                </div>

                <div class="viewNews-content__content">
                    {!! $news->content !!}
                </div>

            </div>
            
        </div>

        <div class="pos_title mt-3 mb-4">
            <h2 class="newbie">@lang('view.news.news_else')</h2>
        </div>

        <div class="news-else">
            @foreach($newsElse as $news)
                <a href="{{ route('news-show', $news->slug) }}" class="news-else__box">
                    <div class="news-else__img">
                        <img src="{{ asset('images') }}/{{ $news->image }}" alt="">
                    </div>
                    <h3 class="news-else__title">{{ $news->title }}</h3>
                    <span class="news-else__time">{{ Carbon\Carbon::parse($news->created_at)->diffForHumans() }}</span>
                </a>
            @endforeach
        </div>

    </div>  

    @include('components.footer')
@endsection