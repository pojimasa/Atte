@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('link')

@section('content')
<div class="login-container">
  <div class="login-form">
    <h2 class="login-form__heading content__heading">ログイン</h2>
    <div class="login-form__inner">
      <form class="login-form__form" action="{{ route('login') }}" method="post">
      @csrf
        <div class="login-form__group">
            <input class="login-form__input" type="mail" name="email" id="email" placeholder="メールアドレス">
              <p class="login-form__error-message">
              @error('email')
              {{ $message }}
              @enderror
              </p>
        </div>
        <div class="login-form__group">
            <input class="login-form__input" type="password" name="password" id="password" placeholder="パスワード">
              <p class="login-form__error-message">
              @error('password')
              {{ $message }}
              @enderror
              </p>
        </div>
        <div class="btn">
          <button class="form__button-submit" type="submit">ログイン</button>
          <a class="form__button-submit" type="submit" href="/register">会員登録</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

