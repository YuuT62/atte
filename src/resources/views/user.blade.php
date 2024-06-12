@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endsection

@section('content')
<div class="user-content">
    <div class="user__header">
        {{ $user_name }}さんの勤怠一覧
    </div>
    <div class="user__header-buttons">
        <form action="/attendance/user/last_month" method="get">
            @csrf
            <input type="hidden" name="date" value=" {{ $date }} ">
            <input type="hidden" name="user_id" value="{{ $user_id }}">
            <input type="hidden" name="user_name" value="{{ $user_name }}">
            <button class="user__header-button"><</button>
        </form>
        <span>{{ $date }}</span>
        <form action="/attendance/user/next_month" method="get">
            @csrf
            <input type="hidden" name="date" value=" {{ $date }} ">
            <input type="hidden" name="user_id" value="{{ $user_id }}">
            <input type="hidden" name="user_name" value="{{ $user_name }}">
            <button class="user__header-button">></button>
        </form>
    </div>
    <div class="user-table">
        <table class="user-table__inner">
            <tr class="user-table__row">
                <th class="user-table__header">勤務日</th>
                <th class="user-table__header">勤務開始</th>
                <th class="user-table__header">勤務終了</th>
                <th class="user-table__header">休憩時間</th>
                <th class="user-table__header">勤務時間</th>
            </tr>
            @foreach($jobs as $job)
            <table class="user-table__inner">
            <tr class="user-table__row">
                <td class="user-table__item">{{ explode(' ',$job['start_job'])[0] }}</td>
                <td class="user-table__item">{{ explode(' ',$job['start_job'])[1] }}</td>
                <td class="user-table__item">
                    @isset($job['end_job'])
                        {{ explode(' ',$job['end_job'])[1] }}
                    @endisset
                </td>
                <td class="user-table__item">{{ $rest_result[$job['id']] }}</td>
                <td class="user-table__item">
                    @if(isset($job['end_job']))
                        {{ $job_result[$job['id']] }}
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="user__page">
        {{ $jobs->appends(request()->input())->links('pagination::default') }}
    </div>
</div>
@endsection