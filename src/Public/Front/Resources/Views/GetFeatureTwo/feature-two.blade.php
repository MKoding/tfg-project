@extends('Shared::Layouts.master')

@section('title')
    Feature Two
@endsection

@section('content')
    <div class="feature-two">
        <div class="feature-two_title">
            <h1>Feature Two</h1>
        </div>
        <div class="feature-two_feature">
            <span>🟢 Hello this a feature controlled by the feature flag => "feature_2" 🟢</span>
        </div>
        <div class="feature-two_home">
            <a href="{{ route('public.home') }}">🏠 - Home</a>
        </div>
    </div>
@endsection
