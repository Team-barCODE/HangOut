@extends('layouts.layout')

@section('content')
<div class="signupPage mb-5">

	<div class="container">
		<form class="form mt-5" method="POST" action="/users/update/{{ $user->id }}" enctype="multipart/form-data">
			@csrf

			@error('email')
				<span class="errorMessage">
				{{ $message }}
				</span>
			@enderror

			<div class="row">
				@php
					$arr = [$user->img_name1, $user->img_name2, $user->img_name3];
				@endphp
				@for($i = 0 ; $i < count($arr) ; $i++)
					<label for="file_photo{{ $i + 1 }}" class="rounded-circle userProfileImg file_photo{{ $i + 1 }}" @if( $arr[$i] != '') style="background-image:url('/storage/images/{{ $arr[$i] }}');background-color:transparent" @endif>
						<div class="userProfileImg_description">画像をアップロード</div>						
							<i class="fas fa-camera fa-3x" @if( $arr[$i] != '' ) style="color:transparent" @endif></i>
						<input type="file" id="file_photo{{ $i + 1 }}" name="img_name{{ $i + 1 }}">
					</label>
				@endfor
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
				<div><label>年齢</label></div>
				<div class="form-check form-check-inline">
					{{$age->age}}歳 ({{$birth_date->year}}年{{$birth_date->month}}月{{$birth_date->day}}日 生まれ)
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
					$education = ['中卒','高卒','高専卒','専門卒','短大卒','大卒','院卒'];
				@endphp
				@for($i = 0 ; $i <= count($education)-1 ; $i++)
					<div class="form-check form-check-inline">
						<input class="form-check-input" name="education" value="{{$i}}" type="radio" id="inlineRadioed{{$i}}" @if($user->education === $i) checked @endif>
						<label class="form-check-label" for="inlineRadioed{{$i}}">{{$education[$i]}}</label>
					</div>
				@endfor
			</div>

			<div class="form-group">
				<div><label>身長</label></div>
				<select name="body_height" id="" class="form-check form-check-inline">
					@for($i = 130 ; $i <= 220 ; $i++ )
						<option value="{{$i}}" @if($user->body_height === $i) selected @endif>{{$i}}cm</option>
					@endfor
				</select>
			</div>

			<div class="form-group">
				<div><label>年収</label></div>
				<select name="income" id="" class="form-check form-check-inline">
					@php
						$income = [null ,100 ,300 ,500 ,700 ,900 ,1250 ,1750 ,2500 ,3000];
						$income_line = ['選択しない', '0〜200万円', '200〜400万円', '400〜600万円', '600〜800万円', '800〜1,000万円', '1,000〜1,500万円', '1,500〜2,000万円', '2,000〜3,000万円', '3,000万円〜',];
					@endphp
					@for($i = 0 ; $i <= count($income)-1 ; $i++ )
						<option value="{{$income[$i]}}" @if($user->income === $income[$i]) selected @endif>{{$income_line[$i]}}</option>
					@endfor
				</select>
			</div>

			<div class="form-group">
				<div><label>同居人の有無</label></div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="housemate" value="0" type="radio" id="inlineRadio7" @if($user->housemate === 0) checked @endif>
					<label class="form-check-label" for="inlineRadio7">無し</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="housemate" value="1" type="radio" id="inlineRadio8" @if($user->housemate === 1) checked @endif>
					<label class="form-check-label" for="inlineRadio8">有り(実家など)</label>
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
