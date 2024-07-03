@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/stamp/index.css') }}">
<style>
    .active-button {
        border: 3px solid #fff700;
        box-shadow: 0 0 10px rgba(255, 204, 0, 0.7);
    }
</style>
@endsection

@section('link')

@endsection

@section('content')
<div class="container">
    <div class="stamp">
        @if (Auth::check())
            <h3>{{ Auth::user()->name }}さん、お疲れ様です！</h3>
        @endif
        <h2>{{ $currentTime ?? '' }}</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="button-grid">
        <form action="{{ route('stamps.store') }}" method="POST" class="button-form">
            @csrf
            <input type="hidden" name="type" value="check_in_time">
            <button type="submit" class="btn btn-primary {{ !isset($status) || $status === 'check_out_time' ? 'active-button' : '' }}"
                    {{ !isset($status) || $status === 'check_out_time' ? '' : 'disabled' }}>
                勤務開始
            </button>
        </form>

        <form action="{{ route('stamps.store') }}" method="POST" class="button-form">
            @csrf
            <input type="hidden" name="type" value="break_start_time">
            <button type="submit" class="btn btn-warning {{ isset($status) && ($status === 'check_in_time' || $status === 'break_end_time') ? 'active-button' : '' }}"
                    {{ isset($status) && ($status === 'check_in_time' || $status === 'break_end_time') ? '' : 'disabled' }}>
                休憩開始
            </button>
        </form>

        <form action="{{ route('stamps.store') }}" method="POST" class="button-form">
            @csrf
            <input type="hidden" name="type" value="break_end_time">
            <button type="submit" class="btn btn-success {{ isset($status) && $status === 'break_start_time' ? 'active-button' : '' }}"
                    {{ isset($status) && $status === 'break_start_time' ? '' : 'disabled' }}>
                休憩終了
            </button>
        </form>

        <form action="{{ route('stamps.store') }}" method="POST" class="button-form">
            @csrf
            <input type="hidden" name="type" value="check_out_time">
            <button type="submit" class="btn btn-danger {{ isset($status) && ($status === 'check_in_time' || $status === 'break_end_time') ? 'active-button' : '' }}"
                    {{ isset($status) && ($status === 'check_in_time' || $status === 'break_end_time') ? '' : 'disabled' }}>
                勤務終了
            </button>
        </form>
    </div>
</div>
@endsection
