@extends('layouts.layout')




@section('content')
<div class="signupPage">
  <div class='container'>
    
    <form class="form mt-5" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
      @csrf
      
      <h2 class="title text-center" style="color:#fd5068">新規登録</h2>
      <label for="file_photo1" class="rounded-circle userProfileImg file_photo1">
        <div class="userProfileImg_description">画像をアップロード</div>
        <i class="fas fa-camera fa-3x"></i>
        <input type="file" id="file_photo1" name="img_name1">
      </label>
      @error('img_name1')
        <div class="text-center">
          <span class="errorMessage">
            {{ $message }}
          </span>
        </div>
      @enderror
      <div class="form-group @error('name')has-error @enderror">
        <label>名前</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="名前を入力してください">
        @error('name')
            <span class="errorMessage">
              {{ $message }}
            </span>
        @enderror
      </div>
      <div class="form-group @error('email')has-error @enderror">
        <label>メールアドレス</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="メールアドレスを入力してください">
        @error('email')
            <span class="errorMessage">
              {{ $message }}
            </span>
        @enderror
      </div>
      <div class="form-group @error('password')has-error @enderror">
        <label>パスワード</label>
        <em>6文字以上入力してください</em>
        <input type="password" name="password" class="form-control" placeholder="パスワードを入力してください">
        @error('password')
            <span class="errorMessage">
              {{ $message }}
            </span>
        @enderror
      </div>
      <div class="form-group">
        <label>確認用パスワード</label>
        <input type="password" name="password_confirmation" class="form-control" placeholder="パスワードを再度入力してください">
      </div>
      <div class="form-group">
        <div><label>性別</label></div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" name="sex" value="0" type="radio" id="inlineRadio1" {{ old('sex','0') == '0' ? 'checked' : '' }}>
          <label class="form-check-label" for="inlineRadio1">男</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" name="sex" value="1" type="radio" id="inlineRadio2" {{ old('sex') == '1' ? 'checked' : '' }}>
          <label class="form-check-label" for="inlineRadio2">女</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" name="sex" value="1" type="radio" id="inlineRadio3" {{ old('sex') == '2' ? 'checked' : '' }}>
          <label class="form-check-label" for="inlineRadio3">LGBT</label>
        </div>
      </div>
      <div class="form-group @error('birth_date')has-error @enderror"">
        <div><label class="form-check-label" for="datepicker">生年月日</label></div>
        <div class="form-check form-check-inline">
          <input class="form-control" name="birth_date" value="{{ old('birth_date') }}" type="text" id="datepicker" autocomplete="off" placeholder="yyyy-mm-dd">
        </div>
        @error('birth_date')
          <span class="errorMessage d-block">
            {{ $message }}
          </span>
        @enderror
      </div>
      <div class="form-group @error('prefecture')has-error @enderror">
        <label>エリア</label>
          <select class="form-control" name="prefecture">
            <option value="" selected>都道府県</option>
            <option value="北海道" {{ old('prefecture') == '北海道' ? 'selected' : '' }}>北海道</option>
            <option value="青森県" {{ old('prefecture') == '青森県' ? 'selected' : '' }}>青森県</option>
            <option value="岩手県" {{ old('prefecture') == '岩手県' ? 'selected' : '' }}>岩手県</option>
            <option value="宮城県" {{ old('prefecture') == '宮城県' ? 'selected' : '' }}>宮城県</option>
            <option value="秋田県" {{ old('prefecture') == '秋田県' ? 'selected' : '' }}>秋田県</option>
            <option value="山形県" {{ old('prefecture') == '山形県' ? 'selected' : '' }}>山形県</option>
            <option value="福島県" {{ old('prefecture') == '福島県' ? 'selected' : '' }}>福島県</option>
            <option value="茨城県" {{ old('prefecture') == '茨城県' ? 'selected' : '' }}>茨城県</option>
            <option value="栃木県" {{ old('prefecture') == '栃木県' ? 'selected' : '' }}>栃木県</option>
            <option value="群馬県" {{ old('prefecture') == '群馬県' ? 'selected' : '' }}>群馬県</option>
            <option value="埼玉県" {{ old('prefecture') == '埼玉県' ? 'selected' : '' }}>埼玉県</option>
            <option value="千葉県" {{ old('prefecture') == '千葉県' ? 'selected' : '' }}>千葉県</option>
            <option value="東京都" {{ old('prefecture') == '東京都' ? 'selected' : '' }}>東京都</option>
            <option value="神奈川県" {{ old('prefecture') == '神奈川県' ? 'selected' : '' }}>神奈川県</option>
            <option value="新潟県" {{ old('prefecture') == '新潟県' ? 'selected' : '' }}>新潟県</option>
            <option value="富山県" {{ old('prefecture') == '富山県' ? 'selected' : '' }}>富山県</option>
            <option value="石川県" {{ old('prefecture') == '石川県' ? 'selected' : '' }}>石川県</option>
            <option value="福井県" {{ old('prefecture') == '福井県' ? 'selected' : '' }}>福井県</option>
            <option value="山梨県" {{ old('prefecture') == '山梨県' ? 'selected' : '' }}>山梨県</option>
            <option value="長野県" {{ old('prefecture') == '長野県' ? 'selected' : '' }}>長野県</option>
            <option value="岐阜県" {{ old('prefecture') == '岐阜県' ? 'selected' : '' }}>岐阜県</option>
            <option value="静岡県" {{ old('prefecture') == '静岡県' ? 'selected' : '' }}>静岡県</option>
            <option value="愛知県" {{ old('prefecture') == '愛知県' ? 'selected' : '' }}>愛知県</option>
            <option value="三重県" {{ old('prefecture') == '三重県' ? 'selected' : '' }}>三重県</option>
            <option value="滋賀県" {{ old('prefecture') == '滋賀県' ? 'selected' : '' }}>滋賀県</option>
            <option value="京都府" {{ old('prefecture') == '京都府' ? 'selected' : '' }}>京都府</option>
            <option value="大阪府" {{ old('prefecture') == '大阪府' ? 'selected' : '' }}>大阪府</option>
            <option value="兵庫県" {{ old('prefecture') == '兵庫県' ? 'selected' : '' }}>兵庫県</option>
            <option value="奈良県" {{ old('prefecture') == '奈良県' ? 'selected' : '' }}>奈良県</option>
            <option value="和歌山県" {{ old('prefecture') == '和歌山県' ? 'selected' : '' }}>和歌山県</option>
            <option value="鳥取県" {{ old('prefecture') == '鳥取県' ? 'selected' : '' }}>鳥取県</option>
            <option value="島根県" {{ old('prefecture') == '島根県' ? 'selected' : '' }}>島根県</option>
            <option value="岡山県" {{ old('prefecture') == '岡山県' ? 'selected' : '' }}>岡山県</option>
            <option value="広島県" {{ old('prefecture') == '広島県' ? 'selected' : '' }}>広島県</option>
            <option value="山口県" {{ old('prefecture') == '山口県' ? 'selected' : '' }}>山口県</option>
            <option value="徳島県" {{ old('prefecture') == '徳島県' ? 'selected' : '' }}>徳島県</option>
            <option value="香川県" {{ old('prefecture') == '香川県' ? 'selected' : '' }}>香川県</option>
            <option value="愛媛県" {{ old('prefecture') == '愛媛県' ? 'selected' : '' }}>愛媛県</option>
            <option value="高知県" {{ old('prefecture') == '高知県' ? 'selected' : '' }}>高知県</option>
            <option value="福岡県" {{ old('prefecture') == '福岡県' ? 'selected' : '' }}>福岡県</option>
            <option value="佐賀県" {{ old('prefecture') == '佐賀県' ? 'selected' : '' }}>佐賀県</option>
            <option value="長崎県" {{ old('prefecture') == '長崎県' ? 'selected' : '' }}>長崎県</option>
            <option value="熊本県" {{ old('prefecture') == '熊本県' ? 'selected' : '' }}>熊本県</option>
            <option value="大分県" {{ old('prefecture') == '大分県' ? 'selected' : '' }}>大分県</option>
            <option value="宮崎県" {{ old('prefecture') == '宮崎県' ? 'selected' : '' }}>宮崎県</option>
            <option value="鹿児島県" {{ old('prefecture') == '鹿児島県' ? 'selected' : '' }}>鹿児島県</option>
            <option value="沖縄県" {{ old('prefecture') == '沖縄県' ? 'selected' : '' }}>沖縄県</option>
          </select>
          @error('prefecture')
            <span class="errorMessage">
              {{ $message }}
            </span>
          @enderror
        </div>
      </div>

      <div class="text-center">
        <button type="submit" class="btn submitBtn">はじめる</button>
        <div class="linkToLogin">
          <a href="{{ route('login') }}">ログインはこちら</a>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ asset('js/auth/register.js') }}"></script>
@endsection
