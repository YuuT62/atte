
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="index-content">
    <div class="index-content__header">
        {{ Auth::user()->name }}さんお疲れ様です！
    </div>
    <div class="index-form">

        <!-- 勤務中 -->
        @if(isset($job_status) && $job_status['status'])
        <div class="index-form__button">
                <button class="index-form__button-submit--false">勤務開始</button>
        </div>

            <!-- 休憩中 -->
            @if(isset($rest_status) && $rest_status['status'])
            <div class="index-form__button">
                <button class="index-form__button-submit--false">勤務終了</button>
            </div>
            <div class="index-form__button">
                <button class="index-form__button-submit--false">休憩開始</button>
            </div>

            <div class="index-form__button">
                <form action="/rest/end" method="post">
                    @csrf
                    <input type="hidden" name="job_id" value="{{ $job_status['id'] }}">
                    <button class="index-form__button-submit">休憩終了</button>
                </form>
            </div>


            <!-- 休憩外 -->
            @else
            <div class="index-form__button">
                <form action="/end" method="post">
                    @csrf
                    <button class="index-form__button-submit">勤務終了</button>
                </form>
            </div>
            <div class="index-form__button">
                <form action="/rest/start" method="post">
                    @csrf
                    <input type="hidden" name="job_id" value="{{ $job_status['id'] }}">
                    <button class="index-form__button-submit">休憩開始</button>
                </form>
            </div>

            <div class="index-form__button">
                <button class="index-form__button-submit--false">休憩終了</button>
            </div>

            @endif


        <!-- 勤務外 -->
        @else
        <div class="index-form__button">
            <form action="/start" method="post">
                @csrf
                <button class="index-form__button-submit">勤務開始</button>
            </form>
        </div>
        <div class="index-form__button">
            <button class="index-form__button-submit--false">勤務終了</button>
        </div>

        <div class="index-form__button">
            <button class="index-form__button-submit--false">休憩開始</button>
            </form>
        </div>

        <div class="index-form__button">
            <button class="index-form__button-submit--false">休憩終了</button>
        </div>
        @endif

    </div>
</div>
@endsection