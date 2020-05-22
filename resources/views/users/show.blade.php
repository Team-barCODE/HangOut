@extends('layouts.layout')

@section('content')

<div class='usershowPage'>
  <div class='container'>
    <div class='userInfo'>
      <div class='userInfo_img'>
      <img src="/storage/images/{{$user ->img_name1}}">
      </div>
      <div class='userInfo_name'>{{ $user->name }}</div>
      <div class=''>{{ $user->prefecture }}</div>
      <div class='userInfo_selfIntroduction'>{{ $user->self_introduction }}</div>
    </div>

    @if(Auth::id() === $user->id)
      <div class='userAction'>
        <div class="userAction_edit userAction_common">
          <a href="/users/edit/{{$user->id}}"><i class="fas fa-edit fa-2x"></i></a>
          <span>情報を編集</span>
        </div>
        <div class='userAction_logout userAction_common'>
        <a href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();"><i class="fas fa-cog fa-2x"></i></a>
          <span>ログアウト</span>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </div>
      </div>
    @endif

  </div>
</div>

@endsection
@section('script')
  @if( url()->previous() === url('') . '/register' )
    <script>window.alert('新規登録からのみアラート\n※最終的にモーダル出してプロフ入力に誘う')</script>
  @endif
@endsection
