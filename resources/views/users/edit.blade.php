@extends('layouts.layout')

@section('content')
<div class="signupPage mb-5">

	<div class="container">
		<form class="form mt-5" method="POST" action="/users/update/{{ $user->id }}" enctype="multipart/form-data">
			@csrf


			<div class="row">
				@php
					$arr = [$user->img_name1, $user->img_name2, $user->img_name3];
				@endphp
				@for($i = 0 ; $i < count($arr) ; $i++)
					<label for="file_photo{{ $i + 1 }}" class="btn btn-primary rounded-circle userProfileImg file_photo{{ $i + 1 }}" @if( $arr[$i] != '') style="background-image:url('/storage/images/{{ $arr[$i] }}');background-color:transparent" @endif>
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
			@error('name')
				<span class="errorMessage">
					{{ $message }}
				</span>
			@enderror


			<div class="form-group">
				<label>メールアドレス</label>
				<input type="email" name="email" class="form-control" value="{{ $user->email }}">
			</div>
			@error('email')
				<span class="errorMessage">
				{{ $message }}
				</span>
			@enderror


			<div class="form-group">
				<div><label>性別</label></div>
				@php
				switch($user->sex){
					case 0:
						$sex = '男性';
						break;
					case 1:
						$sex = '女性';
						break;
					case 3:
						$sex = 'LGBT';
						break;
				}
				@endphp
				<p>{{$sex}}</p>
			</div>


			<div class="form-group">
				<div><label>年齢</label></div>
				<div class="form-check form-check-inline">
					{{$age->age}}歳
				</div>
			</div>

			<div class="form-group">
				<div><label>エリア</label></div>
				<select class="form-control" name="prefecture">
						<option value="">都道府県</option>
						@php
							$pref = ['北海道','青森県','岩手県','宮城県','秋田県','山形県','福島県','茨城県','栃木県','群馬県','埼玉県','千葉県','東京都','神奈川県','新潟県','富山県','石川県','福井県','山梨県','長野県','岐阜県','静岡県','愛知県','三重県','滋賀県','京都府','大阪府','兵庫県','奈良県','和歌山県','鳥取県','島根県','岡山県','広島県','山口県','徳島県','香川県','愛媛県','高知県','福岡県','佐賀県','長崎県','熊本県','大分県','宮崎県','鹿児島県','沖縄県'];
						@endphp
						@for($i = 0 ;$i < count($pref) ; $i++)
							<option value="{{$pref[$i]}}" @if($user->prefecture === $pref[$i]) selected @endif>{{$pref[$i]}}</option>
						@endfor
          </select>
          @error('prefecture')
            <span class="errorMessage">
              {{ $message }}
            </span>
          @enderror

				
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
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="education" value="" type="radio" id="inlineRadioednull" @if($user->education === null) checked @endif>
					<label class="form-check-label" for="inlineRadioednull">選択しない</label>
				</div>
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
				<select name="body_height" id="" class="form-control">
					<option value="">選択しない</option>
					@for($i = 130 ; $i <= 220 ; $i++ )
						<option value="{{$i}}" @if($user->body_height === $i) selected @endif>{{$i}}cm</option>
					@endfor
				</select>
			</div>

			<div class="form-group">
				<div><label>体型</label></div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="body_figure" value="0" type="radio" id="inlineRadio7" @if($user->body_figure === 0) checked @endif>
					<label class="form-check-label" for="inlineRadio7">痩せ型</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="body_figure" value="1" type="radio" id="inlineRadio8" @if($user->body_figure === 1) checked @endif>
					<label class="form-check-label" for="inlineRadio8">普通</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="body_figure" value="2" type="radio" id="inlineRadio9" @if($user->body_figure === 2) checked @endif>
					<label class="form-check-label" for="inlineRadio9">ふくよか・ガッチリ</label>
				</div>
			</div>
			
			<div class="form-group">
				<div><label>趣味</label></div>
				@if(count($myhobbies) !== 0)
					@foreach($hobbies as $hobby)
						@foreach($myhobbies as $myhobby)
							@if($myhobby->hobby_id === $hobby->id)
								<div class="form-check form-check-inline">
									<input class="form-check-input" name="hobbies[]" value="{{$hobby->id}}" type="checkbox" id="inlinecheck{{$hobby->genre}}" checked>
									<label class="form-check-label" for="inlinecheck{{$hobby->genre}}">{{$hobby->genre}}</label>
								</div>
								@break
							@elseif($myhobby->hobby_id !== $hobby->id && $loop->last !== true)
								@continue
							@else
								<div class="form-check form-check-inline">
									<input class="form-check-input" name="hobbies[]" value="{{$hobby->id}}" type="checkbox" id="inlinecheck{{$hobby->genre}}">
									<label class="form-check-label" for="inlinecheck{{$hobby->genre}}">{{$hobby->genre}}</label>
								</div>
							@endif
						@endforeach
					@endforeach
				@else
					@foreach($hobbies as $hobby)
						<div class="form-check form-check-inline">
							<input class="form-check-input" name="hobbies[]" value="{{$hobby->id}}" type="checkbox" id="inlinecheck{{$hobby->genre}}">
							<label class="form-check-label" for="inlinecheck{{$hobby->genre}}">{{$hobby->genre}}</label>
						</div>
					@endforeach
				@endif
			</div>



			<div class="form-group">
				<div><label>性格</label></div>
				@if(count($mypersonalities) !== 0)
					@foreach($personalities as $personality)
						@foreach($mypersonalities as $mypersonality)
							@if($mypersonality->personality_id === $personality->id)
								<div class="form-check form-check-inline">
									<input class="form-check-input" name="personalities[]" value="{{$personality->id}}" type="checkbox" id="inlinecheck0{{$personality->personality}}" checked>
									<label class="form-check-label" for="inlinecheck0{{$personality->personality}}">{{$personality->personality}}</label>
								</div>
								@break
							@elseif($mypersonality->personality_id !== $personality->id && $loop->last !== true)
								@continue
							@else
								<div class="form-check form-check-inline">
									<input class="form-check-input" name="personalities[]" value="{{$personality->id}}" type="checkbox" id="inlinecheck0{{$personality->personality}}">
									<label class="form-check-label" for="inlinecheck0{{$personality->personality}}">{{$personality->personality}}</label>
								</div>
							@endif
						@endforeach
					@endforeach
				@else
					@foreach($personalities as $personality)
						<div class="form-check form-check-inline">
							<input class="form-check-input" name="personalities[]" value="{{$personality->id}}" type="checkbox" id="inlinecheck0{{$personality->personality}}">
							<label class="form-check-label" for="inlinecheck0{{$personality->personality}}">{{$personality->personality}}</label>
						</div>
					@endforeach
				@endif
			</div>


			<div class="form-group">
				<div><label>職種</label></div>
				<select name="myjob" id="" class="form-control">
					<option value="">選択しない</option>
					@if(count($myjob) !== 0)
						@foreach($alljobs as $job)
							@foreach($myjob as $jobtype)
								@if($jobtype->job_id === $job->id)
									<option value="{{$job->id}}" selected>{{$job->job}}</option>
									@break
								@elseif($jobtype->job_id !== $job->id && $loop->last !== true)
									@continue
								@else
									<option value="{{$job->id}}">{{$job->job}}</option>
								@endif
							@endforeach
						@endforeach
					@else
						@foreach($alljobs as $job)
							<option value="{{$job->id}}">{{$job->job}}</option>
						@endforeach
					@endif
				</select>
			</div>
				
				
				
			<div class="form-group">
				<div><label>年収</label></div>
				<select name="income" id="" class="form-control">
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
					<input class="form-check-input" name="housemate" value="0" type="radio" id="inlineRadio10" @if($user->housemate === 0) checked @endif>
					<label class="form-check-label" for="inlineRadio10">無し</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="housemate" value="1" type="radio" id="inlineRadio11" @if($user->housemate === 1) checked @endif>
					<label class="form-check-label" for="inlineRadio11">有り(実家など)</label>
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
