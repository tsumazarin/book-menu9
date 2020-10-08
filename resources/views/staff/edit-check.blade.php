@extends('layouts.book-menu')

@section('login')
    <p>{{ $login_name }}さん、ログイン中</p>
@endsection

@section('heading', 'スタッフ修正')

@section('content')
<form action="" method="post">
  @csrf
  <table class="staff-form">
    <tr>
      <td>お名前</td>
      <td>
        <span class="border-bottom">
          {{ $staff_name }}
        </span>
      </td>
    </tr>
    <tr>
      <td>メールアドレス</td>
      <td>
        <span class="border-bottom">
          {{ $staff_email }}
        </span>
      </td>
    </tr>
    <tr>
      <td>パスワード</td>
      <td>
        <span class="border-bottom">
          【表示されません】
        </span>
      </td>
    </tr>
  </table>
  <div>
    <input class="button black" type="button" onclick="history.back()" value="戻る"> |
    <input class="button black" type="submit" value="修正">
  </div>
</form>
@endsection
