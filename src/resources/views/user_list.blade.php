@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user_list.css') }}">
@endsection

@section('content')
<div class="user-list-content">
    <div class="user-list__header">
        ユーザー一覧
    </div>
    <div class="user-list-table">
        <table class="user-list-table__inner">
            <tr class="user-list-table__row">
                <th class="user-list-table__header">名前</th>
                <th class="user-list-table__header">勤務状況</th>
                <th class="user-list-table__header">最終勤務日</th>
                <th class="user-list-table__header">ユーザー勤怠一覧</th>
            </tr>
            @foreach($users as $user)
                @if(!empty($user['email_verified_at']))
                    <tr class="user-list-table__row">
                        <td class="user-list-table__item">{{ $user['name'] }}</td>
                        <?php $job_count = count($user['job']) ?>
                        @if($job_count != 0)
                            @if($user['job'][count($user['job'])-1]['status'])
                            <td class="user-list-table__item">勤務中</td>
                            @else
                            <td class="user-list-table__item">勤務外</td>
                            @endif
                            <td class="user-list-table__item">{{ explode(' ',$user['job'][count($user['job'])-1]['start_job'])[0] }}</td>
                        @else
                        <td class="user-list-table__item">勤務外</td>
                        <td class="user-list-table__item">なし</td>
                        @endif
                        <td class="user-list-table__item">
                            <form class="user-list-table__form" action="/attendance/user" method="get">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user['id'] }}">
                                <input type="hidden" name="user_name" value="{{ $user['name'] }}">
                                <button>一覧</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>
    </div>
    <div class="user-list__page">
        {{ $users->appends(request()->input())->links('pagination::default') }}
    </div>
</div>
@endsection