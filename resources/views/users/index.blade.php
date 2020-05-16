@extends('layouts.layout')

@section('content')
<div class='userListPage'>
	<nav class="navbar navbar-light w-100 justify-content-md-center px-3" style="background-color: #fd5068;">
		<a href="/users/2"><button type="button" class="btn btn-sm btn-outline-warning">イマイチ！一覧</button></a>
		<a href="/users/"><button type="button" class="btn btn-sm btn-outline-warning mx-2">メンバー一覧</button></a>
		<a href="/users/1"><button type="button" class="btn btn-sm btn-outline-warning">ライク！一覧</button></a>
	</nav>
	<nav class="navbar navbar-light w-100 nav-justified px-3">
	<button type="button" class="btn btn-outline-primary px-3">条件で探す</button>
		<form class="form-inline">
			<input class="form-control mr-sm-2" type="search" placeholder="テキスト検索..." aria-label="テキスト検索...">
			<button type="submit" class="btn btn-outline-success my-2 my-sm-0">検索</button>
		</form>
	</nav>

	<div class='container'>

		<h4 id="" class="list_title">一覧ページ</h4>
		<h4>メンバー数：{{ $userCount }}</h4>
		@if($me->sex == 0)
		<h4>自分は：男</h4>
		@elseif($me->sex == 1)
		<h4>自分は：女</h4>
		@elseif($me->sex == 2)
		<h4>自分は：LGBT</h4>
		@endif

		@if($userCount == 0)
		<h4>
			メンバーはいません。
		</h4>
		@endif
		<div class="row">
			@foreach($users as $user)
				<div class="col-6 col-md-3 text-center mb-2">
					<a class="" href="/users/show/{{$user->id}}">
						<img class="card-img-top image-circle under" alt="カードの画像" src="/storage/images/{{ $user->img_name1 }}">
					</a>
					<div class="card card-body">
					<h5 class="card-title">{{ $user->name }}</h5>
					<p class="badge badge-warning py-1">{{ $user->prefecture }}</p>
					@if(isset($user->sex) && $user->sex == 0)
						<p class="card-text">性別：男</p>
					@elseif(isset($user->sex) && $user->sex == 1)
						<p class="card-text">性別：女</p>
					@elseif(isset($user->sex) && $user->sex == 2)
						<p class="card-text">性別：LGBT</p>
					@endif

					@if(isset($user->self_introduction) && $user->self_introduction != "")
						<p class="card-text">{!! nl2br(e(Str::limit($user->self_introduction, 60))) !!}</p>
					@else
						<p class="card-text">ユーザー詳細はありません</p>
					@endif
					<a class="card-link" href="/users/show/{{$user->id}}">
						続きを読む
					</a>

					@foreach($user->toUserId as $like)
						@if(isset($like->status) && $like->status == "1")
						<span style="color:tomato;">好き</span>
						@elseif(isset($like->status) && $like->status == "2")
						<span style="">嫌い</span>
						@endif
					@endforeach
					<a href="#" class="btn btn-primary">ボタン</a>
					<div class="d-flex justify-content-around">
						<div class="p-2">
							<button type="button" class="btn btn-sm btn-secondary text-nowrap rounded-pill">嫌い</button>
						</div>
						<div class="p-2">
							<button type="button" class="btn btn-sm btn-danger text-nowrap rounded-pill">好き</button>
						</div>
					</div>
					</div>
				</div>
			@endforeach
		</div>
		<br>
	</div>
</div>

@endsection
