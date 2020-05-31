@extends('layouts.layout')

@section('content')

<div class="topPage">
  <div id="tinderslide">
    <ul>
        @foreach($users as $user)
        <li data-user_id="{{ $user->id }}">
          <div class="userName">{{ $user->name }}</div>
          <img src="/storage/images/{{ $user->img_name1}}">
          <div class="like"></div>
          <div class="dislike"></div>
        </li>
        @endforeach
    </ul>
    <div class="noUser">近くにお相手がいません。</div>
  </div>
  <div class="actions" id="actionBtnArea">
      <a href="#" class="dislike"><i class="fas fa-times fa-2x"></i></a>
      <a href="#" class="like"><i class="fas fa-heart fa-2x"></i></a>
  </div>
</div>

<script>
  window.location.href = "/users";
  var usersNum = {{ $userCount }};
  var from_user_id = {{ $from_user_id }};
</script>

@endsection
