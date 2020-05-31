@extends('layouts.layout')

@section('content')
<div class='userListPage'>
	<nav class="navbar navbar-light w-100 justify-content-md-center px-3" style="background-color: #fd5068;">
		<a href="/users/2"><button type="button" class="btn btn-sm btn-outline-warning">イマイチ！一覧</button></a>
		<a href="/users/"><button type="button" class="btn btn-sm btn-outline-warning mx-2">メンバー一覧</button></a>
		<a href="/users/1"><button type="button" class="btn btn-sm btn-outline-warning">ライク！一覧</button></a>
	</nav>
	<nav class="navbar navbar-light w-100 nav-justified px-3">
		<button type="button" class="btn btn-outline-primary px-3" data-toggle="modal" data-target="#searchModal">条件で探す</button>
		<a href="{{ route('matching') }}"><button type="button" class="btn btn-outline-primary px-3">チャットへ</button></a>
		<a href="/users/3"><button type="button" class="btn btn-outline-primary px-3">ライクされた人</button></a>
		<!-- <form class="form-inline">
			<input class="form-control mr-sm-2" type="search" placeholder="テキスト検索..." aria-label="テキスト検索...">
			<button type="submit" class="btn btn-outline-success my-2 my-sm-0">検索</button>
		</form> -->
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
		<h3>{{$status}}</h3>
		<section id="scroll_area"
			data-infinite-scroll='{
				"path": ".pagination a[rel=next]",
				"append": ".result_users"
			}'
		>
			@include('users.listItem')
		</section>
		<div class="d-none">{{ $users->appends(['search'=>$search,'keyword'=>$keyword,'before_age'=>$before_age,'after_age'=>$after_age,'prefecture'=>$prefecture,'before_body_height'=>$before_body_height,'after_body_height'=>$after_body_height,'body_figure'=>$body_figure,'smoke'=>$smoke,'alcohol'=>$alcohol,'education'=>$education,'housemate'=>$housemate,'hobbies'=>$hobbies,'personalities'=>$personalities,'jobs'=>$jobs,'before_income'=>$before_income,'after_income'=>$after_income])->links() }}</div>
		<h4 class="text-center">メンバーは以上です</h4>
		<br>
	</div>
</div>

@include('users.searchModal')

@endsection

@section('script')
<script src="{{ asset('js/infinite-scroll.pkgd.min.js') }}"></script>
<script>
jQuery(document).ready(function() {

	var $container =
	$('#scroll_area').infiniteScroll({
		path : ".pagination a[rel=next]",
		append : ".result_users",
		dataType: "html",
		checkLastPage: true,
		history: false,
		responseType: 'document',
	});

	// ライクをクリック
	$(document).on('click', '.like', function() {
		const toUser = $(this);
		const toId = toUser.attr('data-reaction');
		const panel = $(toUser).parents('.panel');
		console.log(toId)
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},//Headersを書き忘れるとエラーになる
			url: '/api/like',//ご自身のweb.phpのURLに合わせる
			type: 'POST',//リクエストタイプ
			data: {
				'to_user_id': toId,
				'from_user_id': {{ Auth::id() }},
				'reaction': 'like'
			},//Laravelに渡すデータ
		})
		// Ajaxリクエスト成功時の処理
		.done(function(data) {
			// Laravel内で処理された結果がdataに入って返ってくる
			// console.log(toUser);
			panel.removeClass("bg-secondary");
			panel.addClass("bg-danger");
		})
		// Ajaxリクエスト失敗時の処理
		.fail(function(data) {
			alert('Ajaxリクエスト失敗');
			console.log(data.responseJSON);
		});
	});

	// ディスライクをクリック
	$(document).on('click', '.disLike', function() {
		const toUser = $(this);
		const toId = toUser.attr('data-reaction');
		const panel = $(toUser).parents('.panel');
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},//Headersを書き忘れるとエラーになる
			url: '/api/like',//ご自身のweb.phpのURLに合わせる
			type: 'POST',//リクエストタイプ
			data: {
				'to_user_id': toId,
				'from_user_id': {{ Auth::id() }},
				'reaction': 'disLike'
			},//Laravelに渡すデータ
		})
		// Ajaxリクエスト成功時の処理
		.done(function(data) {
			// Laravel内で処理された結果がdataに入って返ってくる
			// console.log("成功");
			panel.removeClass("bg-danger");
			panel.addClass("bg-secondary");
		})
		// Ajaxリクエスト失敗時の処理
		.fail(function(data) {
			alert('Ajaxリクエスト失敗');
			console.log(data.responseJSON);
		});
	});


});
</script>
@endsection
