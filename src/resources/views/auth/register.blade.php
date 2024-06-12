@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register-content">
    <div class="register-content__header">
        会員登録
    </div>
    <form class="register-form" action="/register" method="post">
        @csrf
        <div class="register-form__name">
            <input type="text" name="name" value="{{ old('name') }}" placeholder="名前">
        </div>
        <div class="login-form__error">
            @error('name')
                <span>※</span>
                {{ $message }}
            @enderror
        </div>

        <div class="register-form__email">
            <input type="text" name="email" value="{{ old('email') }}" placeholder="メールアドレス">
        </div>
        <div class="login-form__error">
            @error('email')
                <span>※</span>
                {{ $message }}
            @enderror
        </div>

        <div class="register-form__password">
            <input type="password" name="password" placeholder="パスワード">
        </div>
        <div class="login-form__error">
            @error('password')
                <span>※</span>
                {{ $message }}
            @enderror
        </div>

        <div class="register-form__password">
            <input type="password" name="password_confirmation" placeholder="確認用パスワード">
        </div>
        <div class="login-form__error">
            @error('password_confirmation')
                <span>※</span>
                {{ $message }}
            @enderror
        </div>

        <div class="register-form__button">
            <button>会員登録</button>
        </div>
    </form>
    <form class="login-form" action="">
        <span>アカウントをお持ちの方はこちらから</span>
        <div class="login-form__button">
            <a href="/login">ログイン</a>
        </div>
    </form>
</div>
@endsection