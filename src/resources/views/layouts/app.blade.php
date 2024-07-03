<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Atte</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/layouts/common.css')}}">
  @yield('css')
</head>

<body>
  <div class="app">
    <header class="header">
      <h1 class="header__heading">Atte</h1>
      @yield('link')
      <nav>
        @if(!Request::is('login','register'))
          <ul class="header-nav">
            <li class="header-nav__item">
              <a class="header-nav__link" href="/stamp">ホーム</a>
            </li>
            <li class="header-nav__item">
              <a class="header-nav__link" href="/attendance">日付一覧</a>
            </li>
            <li class="header-nav__item">
              <a class="header-nav__link" href="/userlist">ユーザー一覧</a>
            </li>
            <li class="header-nav__item">
              <a class="header-nav__link" href="/attendance/user">ユーザー勤怠情報管理</a>
            </li>
            <li class="header-nav__item">
              <form action="{{ route('logout.confirm') }}" method="post">
                @csrf
                <button class="header-nav__link">ログアウト</button>
              </form>
            </li>
            @endif
          </ul>
        </nav>
    </header>
    <div class="content">
      @yield('content')
    </div>
    <footer class="footer">
      <p class="footer__footing">atte,inc.</p>
    </footer>
  </div>
</body>

</html>
