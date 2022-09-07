@php
    use Src\Public\Front\src\Controllers\GetHome\GetHomeView;
    /** @var $getHomeView GetHomeView */
@endphp

@extends('Shared::Layouts.master')

@section('title')
    Main
@endsection

@section('content')
    <div class="home">
        <div class="home_title">
            <h1>Home of the TFG Project</h1>
        </div>
        @if($getHomeView->useFeature('feature_1'))
            <div class="home_feature">
                <span>🟢 Hello this a feature controlled by the feature flag => "feature_1" 🟢</span>
            </div>
        @endif
        @if($getHomeView->useFeature('feature_2'))
            <div class="home_feature">
                <a href="{{ route('public.feature-two') }}">🟢 - Feature Two</a>
            </div>
        @else
            <div class="home_feature">
                <span>🔴 - Feature Unavailable</span>
            </div>
        @endif
        <div class="home_feature">
            <a href="{{ route('admin.feature-flags') }}">🏳 - Feature Flags Manager</a>
        </div>
        <div class="home_version">
            <span class="text_bold">v1.1.0</span>
        </div>
    </div>
@endsection
