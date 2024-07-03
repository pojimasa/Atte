@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('content')
<div class="register-container">
  <main class="register-form">
    <h2 class="register-form__heading content__heading">会員登録</h2>
    <div class="register-form__inner">
      <form class="register-form__form" action="{{ route('register') }}" method="post">
      @csrf
        <div class="register-form__group">
          <input class="register-form__input" type="text" name="name" id="name" placeholder="お名前" value="{{ old('name') }}">
          <p class="register-form__error-message">
          @error('name')
          {{ $message }}
          @enderror
          </p>
        </div>
      <div class="register-form__group">
        <input class="register-form__input" type="text" name="email" id="email" placeholder="メールアドレス" value="{{ old('email') }}">
        <p class="register-form__error-message">
          @error('email')
          {{ $message }}
          @enderror
        </p>
      </div>
      <div class="register-form__group">
        <input class="register-form__input" type="password" name="password" id="password" placeholder="パスワード">
        <p class="register-form__error-message">
          @error('password')
          {{ $message }}
          @enderror
        </p>
      </div>
      <div class="register-form__group">
        <input class="register-form__input" type="password" name="password_confirmation" id="password_confirmation" placeholder="確認用パスワード">
        <p class="register-form__error-message">
          @error('password_confirmation')
          {{ $message }}
          @enderror
        </p>
      </div>
      <div class="btn">
        <button class="register-form__btn" type="submit">登録</button>
        <a class="register-form__btn" href="{{ route('login') }}">ログイン</a>
      </div>
    </form>
    </div>
  </main>
</div>
@endsection
