<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログアウト確認</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/layouts/common.css')}}">
  @yield('css')
</head>
<body>
  <div class="app">
    <header class="header">
      <h1 class="header__heading">Atte</h1>
    </header>
    <div class="content">
      <h2>本当にログアウトしますか？</h2>
        <div class="logout">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit">はい</button>
                <a href="{{ url()->previous() }}">いいえ</a>
            </form>
        </div>
    </div>
    <footer class="footer">
      <p class="footer__footing">atte,inc.</p>
    </footer>
  </div>
</body>
</html>