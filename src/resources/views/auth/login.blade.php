@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login-content">
    <div class="login-content__header">
        ログイン
    </div>
    <form class="login-form" action="/login" method="post">
        @csrf
        <div class="login-form__email">
            <input type="text" name="email" value="{{ old('email') }}" placeholder="メールアドレス">
        </div>
        <div class="login-form__password">
            <input type="password" name="password" placeholder="パスワード">
        </div>
        <div class="login-form__button">
            <button>ログイン</button>
        </div>
    </form>
    <form class="register-form" action="">
        <span>アカウントをお持ちでない方はこちらから</span>
        <div class="register-form__button">
            <a href="/register">会員登録</a>
        </div>
    </form>
</div>
@endsection