@php
    use Src\Admin\Front\src\Controllers\GetFeatureFlags\GetFeatureFlagsView;
    /** @var $getFeatureFlagsView GetFeatureFlagsView */
@endphp

@extends('Shared::Layouts.master')

@section('title')
    Feature flags table
@endsection

@section('content')
    <div class="feature-flags">
        <div class="feature-flags_title">
            <h1>Feature Flags Table</h1>
        </div>
        <table class="feature-flags_table">
            <tr>
                <th>Feature</th>
                <th>Status</th>
            </tr>
            @foreach($getFeatureFlagsView->getFeatureFlags() as $featureFlag)
                <tr class="feature-flag_flag">
                    <td class="feature-flag_flag_name">
                        {{ $featureFlag->getName() }}
                    </td>
                    <td class="feature-flag_flag_status">
                        <form method="post" action="{{ route('feature-flags.edit') }}">
                            <input type="hidden" name="name" value="{{ $featureFlag->getName() }}" />
                            <input type="hidden" name="enabled" value="{{ !$featureFlag->isEnabled() ? '1' : '0' }}" />
                            <a class="feature-flag_flag_status_anchor"
                               onclick="this.parentNode.submit();">
                                {{ $featureFlag->isEnabled() ? '🟢' : '🔴' }}
                            </a>
                        </form>
                    </td>
                    <td class="feature-flag_flag_delete">
                        <form method="post" action="{{ route('feature-flags.delete') }}">
                            <input type="hidden" name="name" value="{{ $featureFlag->getName() }}" />
                            <a class="feature-flag_flag_delete_anchor"
                               onclick="this.parentNode.submit();">
                                🗑
                            </a>
                        </form>
                    </td>
                </tr>
            @endforeach
            <form id="add-feature-flag-form" method="post" action="{{ route('feature-flags.add') }}">
                <tr class="feature-flag_flag">
                    <td class="feature-flag_flag_name">
                        <input class="feature-flag_flag_name_input" type="text" name="name" />
                    </td>
                    <td class="feature-flag_flag_status">
                        <select class="feature-flag_flag_status_input" name="enabled" form="add-feature-flag-form">
                            <option value="1">🟢</option>
                            <option value="0" selected>🔴</option>
                        </select>
                    </td>
                    <td class="feature-flag_flag_add">
                        <a class="feature-flag_flag_add_anchor"
                           onclick="document.getElementById('add-feature-flag-form').submit();">
                            ➕
                        </a>
                    </td>
                </tr>
            </form>
        </table>
    </div>
@endsection
