<!-- モーダルの設定 -->
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="searchModalLabel">条件で絞り込んで検索する</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form" method="GET" action="/users/search">

            <div><label>※絞り込み検索は<span style="color:tomato">ライク</span>と<span style="color:tomato">イマイチ</span>を含みます</label></div>
            <div><label>テキスト検索　※複数キーワードはスペースをあけてください</label></div>
            <div class="form-group">
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="search" value="0" type="radio" id="nameRadio1" checked="checked">
					<label class="form-check-label" for="nameRadio1">名前で検索</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="search" value="1" type="radio" id="nameRadio2">
					<label class="form-check-label" for="nameRadio2">自己紹介文で検索</label>
				</div>
			</div>
            <div class="container form-group">
                <div class="row">
                    <div><input name="keyword" class="form-control  mr-sm-2" type="search" placeholder="検索..." aria-label="検索..."></div>
                    <div><button type="submit" class="btn btn-outline-success ml-2">検索</button></div>
                </div>

			</div>
			@error('keyword')
				<span class="errorMessage">
					{{ $message }}
				</span>
			@enderror

            <div class="container row">
                <div class="form-group">
                    <label>年齢：何歳から</label>
                    <select name="before_age" id="before_age" class="form-control">
                        <option value="">選択しない</option>
                        @for($i = 20 ; $i <= 100 ; $i++ )
                            <option value="{{$i}}">{{$i}}歳</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label></label>
                    <div class="mt-3">　〜　</div>
                </div>
                <div class="form-group">
                    <label>何歳まで</label>
                    <select name="after_age" id="after_age" class="form-control">
                        <option value="">選択しない</option>
                        @for($i = 20 ; $i <= 100 ; $i++ )
                            <option value="{{$i}}">{{$i}}歳</option>
                        @endfor
                    </select>
                </div>
                @error('before_age || after_age')
                    <span class="errorMessage">
                        {{ $message }}
                    </span>
                @enderror
            </div>



			<div class="form-group">
				<label>エリア</label>
				<select class="form-control" name="prefecture">
						<option value="">都道府県</option>
						@php
							$pref = ['北海道','青森県','岩手県','宮城県','秋田県','山形県','福島県','茨城県','栃木県','群馬県','埼玉県','千葉県','東京都','神奈川県','新潟県','富山県','石川県','福井県','山梨県','長野県','岐阜県','静岡県','愛知県','三重県','滋賀県','京都府','大阪府','兵庫県','奈良県','和歌山県','鳥取県','島根県','岡山県','広島県','山口県','徳島県','香川県','愛媛県','高知県','福岡県','佐賀県','長崎県','熊本県','大分県','宮崎県','鹿児島県','沖縄県'];
						@endphp
						@for($i = 0 ;$i < count($pref) ; $i++)
							<option value="{{$pref[$i]}}">{{$pref[$i]}}</option>
						@endfor
				</select>
			</div>
			@error('prefecture')
				<span class="errorMessage">
				{{ $message }}
				</span>
			@enderror

            <div class="container row">
                <div class="form-group">
                    <label>身長：何cmから</label>
                    <select name="before_body_height" id="before_body_height" class="form-control">
                        <option value="">選択しない</option>
                        @for($i = 130 ; $i <= 220 ; $i++ )
                            <option value="{{$i}}">{{$i}}cm</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label></label>
                    <div class="mt-3">　〜　</div>
                </div>
                <div class="form-group">
                    <label>何cmまで</label>
                    <select name="after_body_height" id="after_body_height" class="form-control">
                        <option value="">選択しない</option>
                        @for($i = 130 ; $i <= 220 ; $i++ )
                            <option value="{{$i}}">{{$i}}cm</option>
                        @endfor
                    </select>
                </div>
                @error('before_body_height || after_body_height')
                    <span class="errorMessage">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="form-group">
				<div><label>体型</label></div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="body_figure" value="0" type="radio" id="inlineRadio7">
					<label class="form-check-label" for="inlineRadio7">痩せ型</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="body_figure" value="1" type="radio" id="inlineRadio8">
					<label class="form-check-label" for="inlineRadio8">普通</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="body_figure" value="2" type="radio" id="inlineRadio9">
					<label class="form-check-label" for="inlineRadio9">ふくよか・ガッチリ</label>
				</div>
			</div>
			@error('body_figure')
				<span class="errorMessage">
					{{ $message }}
				</span>
			@enderror

            <div class="form-group">
                <div><label>喫煙の有無</label></div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="smoke" value="0" type="radio" id="inlineRadio3">
					<label class="form-check-label" for="inlineRadio3">禁煙</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="smoke" value="1" type="radio" id="inlineRadio4">
					<label class="form-check-label" for="inlineRadio4">喫煙</label>
				</div>
			</div>
			@error('smoke')
				<span class="errorMessage">
					{{ $message }}
				</span>
			@enderror

            <div class="form-group">
                <div><label>飲酒の有無</label></div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="alcohol" value="0" type="radio" id="inlineRadio5">
					<label class="form-check-label" for="inlineRadio5">飲まない</label>
				</div>

				<div class="form-check form-check-inline">
					<input class="form-check-input" name="alcohol" value="1" type="radio" id="inlineRadio6">
					<label class="block form-check-label" for="inlineRadio6">飲む</label>
				</div>
			</div>
			@error('alcohol')
				<span class="errorMessage">
					{{ $message }}
				</span>
			@enderror

            <div class="form-group">
                <div><label>学歴</label></div>
                @php
					$education = ['中卒','高卒','高専卒','専門卒','短大卒','大卒','院卒'];
				@endphp

                @for($i = 0 ; $i < count($education) ; $i++)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="education[]" value="{{$i}}" type="checkbox" id="education{{$i}}">
                        <label class="form-check-label" for="education{{$i}}">{{$education[$i]}}</label>
                    </div>
                @endfor
			</div>
			@error('education')
				<span class="errorMessage">
					{{ $message }}
				</span>
			@enderror

            <div class="form-group">
                <div><label>同居人の有無</label></div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="housemate" value="0" type="radio" id="inlineRadio10">
					<label class="form-check-label" for="inlineRadio10">無し</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="housemate" value="1" type="radio" id="inlineRadio11">
					<label class="form-check-label" for="inlineRadio11">有り(実家など)</label>
				</div>
			</div>
			@error('housemate')
				<span class="errorMessage">
					{{ $message }}
				</span>
			@enderror

            <div class="form-group">
                <div><label>趣味</label></div>
				@foreach($hobbiesMaster as $hobby)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="hobbies[]" value="{{$hobby->id}}" type="checkbox" id="inlinecheck{{$hobby->genre}}">
                        <label class="form-check-label" for="inlinecheck{{$hobby->genre}}">{{$hobby->genre}}</label>
                    </div>
                @endforeach
			</div>
			@error('hobbies[]')
				<span class="errorMessage">
					{{ $message }}
				</span>
			@enderror

            <div class="form-group">
                <div><label>性格</label></div>
				@foreach($personalitiesMaster as $personality)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="personalities[]" value="{{$personality->id}}" type="checkbox" id="inlinecheck0{{$personality->personality}}">
                        <label class="form-check-label" for="inlinecheck0{{$personality->personality}}">{{$personality->personality}}</label>
                    </div>
                @endforeach
			</div>
			@error('personalities[]')
				<span class="errorMessage">
					{{ $message }}
				</span>
			@enderror

            <div class="form-group">
                <div><label>職種</label></div>
				@foreach($jobsMaster as $job)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="jobs[]" value="{{$job->id}}" type="checkbox" id="jobs{{$job->job}}">
                        <label class="form-check-label" for="jobs{{$job->job}}">{{$job->job}}</label>
                    </div>
                @endforeach
			</div>
			@error('jobs[]')
				<span class="errorMessage">
					{{ $message }}
				</span>
			@enderror

            <div class="container row">
                <div class="form-group">
                    <div><label>年収：いくらから</label></div>
                    <select name="before_income" id="before_income" class="form-control">
                        @php
                            $income = [null ,100 ,200 ,400 ,600 ,800 ,1000 ,1500 ,2000 ,3000];
                            $income_line = ['選択しない', '100万円', '200万円', '400万円', '600万円', '800万円', '1,000万円', '1,500万円', '2,000万円', '3,000万円〜',];
                        @endphp
                        @for($i = 0 ; $i < count($income) ; $i++ )
                            <option value="{{$income[$i]}}">{{$income_line[$i]}}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label></label>
                    <div class="mt-3">　〜　</div>
                </div>
                <div class="form-group">
                    <div><label>いくらまで</label></div>
                    <select name="after_income" id="after_income" class="form-control">
                        @php
                            $income = [null ,100 ,200 ,400 ,600 ,800 ,1000 ,1500 ,2000 ,3000];
                            $income_line = ['選択しない', '100万円', '200万円', '400万円', '600万円', '800万円', '1,000万円', '1,500万円', '2,000万円', '3,000万円〜',];
                        @endphp
                        @for($i = 0 ; $i < count($income) ; $i++ )
                            <option value="{{$income[$i]}}">{{$income_line[$i]}}</option>
                        @endfor
                    </select>
                </div>
                @error('before_income || after_income')
                    <span class="errorMessage">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
            <button type="submit" class="btn btn-primary">検索！</button>
        </div><!-- /.modal-footer -->
        </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
