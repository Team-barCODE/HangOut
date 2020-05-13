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
						<input class="form-check-input" name="education" value="{{$i}}" type="radio" id="inlineRadioed{{$i}}" @if($user->education === $i) checked @endif>
						<label class="form-check-label" for="inlineRadioed{{$i}}">{{$edcation[$i]}}</label>
					</div>
				@endfor
			</div>
						

			<div class="form-group">
				<div><label>身長</label></div>
				<div class="form-check form-check-inline">
					<select name="body_height" id="" class="form-check-input form-check-inline form-control">
						@for($i = 130 ; $i <= 220 ; $i++)
							<option value="{{$i}}" @if($user->body_height === $i ) selected @endif>{{$i}}cm</option>
						@endfor
					</select>
				</div>
			</div>

			<div class="form-group">
				<div><label>年収</label></div>
				<div class="form-check form-check-inline">
					<select name="income" id="" class="form-check-input form-check-inline form-control">
						@php
							$income = [null,0, 300, 500, 700, 900, 1250 ,1750 , 2500, 3000];
							$income_rank = ['未回答','0〜100万円','200〜400万円','400〜600万円','600〜800万円','800〜1000万円','1,000〜1,500万円','1,500〜2,000万円','2,000〜3,000万円','3,000万円〜'];
						@endphp
						@for($i = 0 ; $i <= count($income)-1 ; $i++)
							<option value="{{$income[$i]}}" @if($user->income === $income[$i] ) selected @endif>{{$income_rank[$i]}}</option>
						@endfor
					</select>
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
