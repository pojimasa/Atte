@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/userlist/index.css') }}">
@endsection

@section('link')

@endsection
@section('content')
<div class="container">
    <h2>ユーザー一覧</h2>
    <div class="table-container">
        <div class="table-wrapper">
            <div class="table-inner">
                <table class="table">
                    <thead>
                        <tr>
                            <th>名前</th>
                            <th>メールアドレス</th>
                            <th>アクション</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">削除</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
