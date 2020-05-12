@extends('layouts.layout')

@section('content')
<div class="signupPage mb-5">
	<header class="header">
		<div>プロフィールを編集</div>
	</header>

	<div class="container">
		<form class="form mt-5" method="POST" action="/users/update/{{ $user->id }}" enctype="multipart/form-data">
			@csrf

			@error('email')
				<span class="errorMessage">
				{{ $message }}
				</span>
			@enderror

			<label for="file_photo" class="rounded-circle userProfileImg">
				<div class="userProfileImg_description">画像をアップロード</div>
				<i class="fas fa-camera fa-3x"></i>
				<input type="file" id="file_photo" name="img_name1">
			</label>

			<div class="userImgPreview is-active" id="userImgPreview">
				<img id="thumbnail" class="userImgPreview_content" accept="image/*" src="/storage/images/{{$user ->img_name1}}">
				<p class="userImgPreview_text">画像をアップロード済み</p>
			</div>

			<div class="form-group">
				<label>名前</label>
				<input type="text" name="name" class="form-control" value="{{ $user->name }}">
			</div>

			<div class="form-group">
				<label>メールアドレス</label>
				<input type="email" name="email" class="form-control" value="{{ $user->email }}">
			</div>

			<div class="form-group">
				<div><label>性別</label></div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="sex" value="0" type="radio" id="inlineRadio1" @if($user->sex === 0) checked @endif>
					<label class="form-check-label" for="inlineRadio1">男</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="sex" value="1" type="radio" id="inlineRadio2" @if($user->sex === 1) checked @endif>
					<label class="form-check-label" for="inlineRadio2">女</label>
				</div>
			</div>

			<div class="form-group">
				<div><label>喫煙の有無</label></div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="smoke" value="0" type="radio" id="inlineRadio3" @if($user->smoke === 0) checked @endif>
					<label class="form-check-label" for="inlineRadio3">禁煙</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="smoke" value="1" type="radio" id="inlineRadio4" @if($user->smoke === 1) checked @endif>
					<label class="form-check-label" for="inlineRadio4">喫煙</label>
				</div>
			</div>

			<div class="form-group">
				<div><label>飲酒の有無</label></div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="alcohol" value="0" type="radio" id="inlineRadio5" @if($user->alcohol === 0) checked @endif>
					<label class="form-check-label" for="inlineRadio5">飲まない</label>
				</div>

				<div class="form-check form-check-inline">
					<input class="form-check-input" name="alcohol" value="1" type="radio" id="inlineRadio6" @if($user->alcohol === 1) checked @endif>
					<label class="block form-check-label" for="inlineRadio6">飲む</label>
				</div>
			</div>
			

			<div class="form-group">
				<div><label>最終学歴</label></div>
				@php
					$edcation = ['中卒','高卒','高専卒','専門卒','短大卒','大卒','院卒'];
				@endphp
				@for($i = 0 ; $i <= count($edcation)-1 ; $i++)
					<div class="form-check form-check-inline">
						<input class="form-check-input" name="education" value="{{$i}}" type="radio" id="inlineRadioed{{$i}}" @if($user->education === 0) checked @endif>
						<label class="form-check-label" for="inlineRadioed{{$i}}">{{$edcation[$i]}}</label>
					</div>
				@endfor
			</div>
						

			<div class="form-group">
				<div><label>身長</label></div>
				<div class="form-check form-check-inline form-control">
					<input class="form-check-input form-control" name="body_height" type="number" min="130.0" max="220.0" step="0.1" @if($user->body_height !== null) value="{{$user->body_height}}" @else value="150.0" @endif>cm
				</div>
			</div>


			<div class="form-group">
				<label>自己紹介文</label>
				<textarea class="form-control" name="self_introduction" rows="10">{{$user->self_introduction}}</textarea>
			</div>

			<div class="text-center">
				<button type="submit" class="btn loginPage_contents_btn">変更する</button>
			</div>
		</form>
	</div>
</div>
@endsection
