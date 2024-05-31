@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('content')
<div class="attendance-content">
    <div class="attendance-content__header">
        <form action="/attendance/yesterday" method="get">
            @csrf
            <input type="hidden" name="date" value="{{ $date }}">
            <button class="attendance-content__header-button"><</button>
        </form>
        <span>{{ $date }}</span>
        <form action="/attendance/tomorrow" method="post">
            @csrf
            <input type="hidden" name="date" value="{{ $date }}">
            <button class="attendance-content__header-button">></button>
        </form>
    </div>
    <div class="attendance-table">
        <table class="attendance-table__inner">
            <tr class="attendance-table__row">
                <th class="attendance-table__header">名前</th>
                <th class="attendance-table__header">勤務開始</th>
                <th class="attendance-table__header">勤務終了</th>
                <th class="attendance-table__header">休憩時間</th>
                <th class="attendance-table__header">勤務時間</th>
            </tr>
            @foreach($jobs as $job)
            <tr class="attendance-table__row">
                <td class="attendance-table__item">{{ $job['user']['name'] }}</td>
                <td class="attendance-table__item">{{ explode(' ',$job['start_job'])[1] }}</td>
                <td class="attendance-table__item">
                    @if(isset($job['end_job']))
                        {{ explode(' ',$job['end_job'])[1] }}
                    @endif
                </td>
                <td class="attendance-table__item">{{ $rest_result[$job['id']] }}</td>
                <td class="attendance-table__item">
                    @if(isset($job['end_job']))
                        {{ $job_result[$job['id']] }}
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="attendance__page">
        {{ $jobs->appends(request()->input())->links('pagination::default') }}
    </div>
</div>
@endsection