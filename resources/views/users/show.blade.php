@extends('layouts.layout')

@section('content')

<div class='usershowPage'>
  <div class='container pt-4'>
  @foreach($user->fromUserId as $likefromuser)
    @foreach($user->toUserId as $liketouser)
      @if($likefromuser->to_user_id == Auth::id() && $liketouser->to_user_id == $user->id)
        <div>
          <h3 class="text-center h3">
            
            {{$user->name}}さんと<br>両思いです。
          </h3>
          <h3 class="text-center h3">
            <i class="fas fa-heart"></i>
            <i class="fas fa-exchange-alt"></i>
            <i class="far fa-smile"></i>
          </h3>
        </div>
        @break
      @elseif($likefromuser->to_user_id == Auth::id())
        <div>
          <h3 class="text-center h3">
            {{$user->name}}さんから<br>好かれています。
          </h3>
          <h3 class="text-center h3">
            <i class="fas fa-heart"></i>
            <i class="fas fa-exchange-alt"></i>
            <i class="far fa-smile"></i>
          </h3>
        </div>
        @break
      @endif
    @endforeach
  @endforeach

    <div class='userInfo card'>
      <div class='userInfo_name card-header mt-0'>{{ $user->name }}</div>
      @if($user->reportToUser->isEmpty() === true)
        <div class='thumbnail' style="background-image:url('/storage/images/{{$user ->img_name1}}')">
        </div>
        @if($user->img_name2 !== '' || $user->img_name3 !== '')
          <div class="row pl-4 pr-4">
            <div class='userProfileImg_mini' style="background-image:url('/storage/images/{{$user ->img_name1}}')">
            </div>
            @if($user->img_name2 !== '')
              <div class='userProfileImg_mini' style="background-image:url('/storage/images/{{$user ->img_name2}}')">
              </div>
            @endif
            @if($user->img_name3 !== '')
              <div class='userProfileImg_mini' style="background-image:url('/storage/images/{{$user ->img_name3}}')">
              </div>
            @endif
          </div>
        @endif
        <table class="table mt-2 mb-0 table-bordered table-striped">
          <tr>
            <th class="text-nowrap w-25">性別</th>
            <td>
              @php
                switch($user->sex){
                  case 0:
                    $figure = '男性';
                    break;
                  case 1:
                    $figure = '女性';
                    break;
                  case 2:
                    $figure = 'LGBT';
                    break;
                }
                echo $figure;
              @endphp
            </td>
          </tr>
          <tr>
            <th class="text-nowrap w-25">年齢</th>
            <td>{{ $age->age }}歳</td>
          </tr>
          <tr>
            <th class="text-nowrap">エリア</th>
            <td>{{ $user->prefecture }}</td>
          </tr>
          @if($user->body_height !== null)
            <tr>
              <th class="text-nowrap">身長</th>
              <td>{{ $user->body_height }}cm</td>
            </tr>
          @endif
          @if($user->body_figure !== null)
            <tr>
              <th class="text-nowrap">体型</th>
              <td>
                @php
                  switch($user->body_figure){
                    case 0:
                      $figure = '痩せ型';
                      break;
                    case 1:
                      $figure = '普通';
                      break;
                    case 2:
                      $figure = 'ふくよか・ガッチリ';
                      break;
                  }
                  echo $figure;
                @endphp
              </td>
            </tr>
          @endif
          @if($user->smoke !== null)
            <tr>
              <th class="text-nowrap">喫煙の有無</th>
              <td>{{ $user->smoke == 0 ? '禁煙' : '喫煙' }}</td>
            </tr>
          @endif
          @if($user->alcohol !== null)
            <tr>
              <th class="text-nowrap">お酒</th>
              <td>{{ $user->alcohol == 0 ? '飲まない' : '飲む' }}</td>
            </tr>
          @endif
          @if($user->education !== null)
            <tr>
              <th class="text-nowrap">学歴</th>
              <td>
                @php
                  $education = ['中卒','高卒','高専卒','専門卒','短大卒','大卒','院卒'];
                @endphp
                @for($i = 0 ; $i < count($education) ; $i++)
                  {{ $user->education == $i ? $education[$i] : null}}
                @endfor
              </td>
            </tr>
          @endif
          @if($user->housemate !== null)
            <tr>
              <th class="text-nowrap">同居人</th>
              <td>{{ $user->housemate == 0 ? '無し' : '有り' }}</td>
            </tr>
          @endif
          @if($user->hobbyId->isEmpty() !== true)
            <tr>
              <th class="text-nowrap">趣味</th>
              <td>
                @foreach($hobbies as $hobby)
                  @foreach($user->hobbyId as $myhobby)
                    @if($myhobby->hobby_id === $hobby->id)
                        <span class="d-inline-block btn btn-danger disabled m-1 font-weight-bold">{{$hobby->genre}}</span>
                      @break
                    @elseif($myhobby->hobby_id !== $hobby->id && $loop->last !== true)
                      @continue
                    @else
                      @break
                    @endif
                  @endforeach
                @endforeach
              </td>
            </tr>
          @endif

          @if($user->personalityId->isEmpty() !== true)
            <tr>
              <th class="text-nowrap">性格</th>
              <td>
                @foreach($personalities as $personality)
                  @foreach($user->personalityId as $mypersonality)
                    @if($mypersonality->personality_id === $personality->id)
                      <span class="d-inline-block btn btn-danger disabled m-1 font-weight-bold">{{$personality->personality}}</span>
                      @break
                    @elseif($mypersonality->personality_id !== $personality->id && $loop->last !== true)
                      @continue
                    @else
                      @break
                    @endif
                  @endforeach
                @endforeach
              </td>
            </tr>
          @endif
          @if($user->jobId->isEmpty() !== true)
            <tr>
              <th class="text-nowrap">職種</th>
              <td>
                @foreach($alljobs as $job)
                  @foreach($user->jobId as $jobtype)
                    @if($jobtype->job_id === $job->id)
                      {{$job->job}}
                      @break
                    @elseif($jobtype->job_id !== $job->id && $loop->last !== true)
                      @continue
                    @else
                      @break
                    @endif
                  @endforeach
                @endforeach
              </td>
            </tr>
          @endif
          @if($user->income !== null)
            <tr>
              <th class="text-nowrap">年収</th>
              <td>
                @php
                  $income = [null ,100 ,300 ,500 ,700 ,900 ,1250 ,1750 ,2500 ,3000];
                  $income_line = ['選択しない', '0〜200万円', '200〜400万円', '400〜600万円', '600〜800万円', '800〜1,000万円', '1,000〜1,500万円', '1,500〜2,000万円', '2,000〜3,000万円', '3,000万円〜',];
                @endphp
                @for($i = 0 ; $i < count($income)  ; $i++ )
                  @if($user->income === $income[$i])
                    {{$income_line[$i]}}
                  @endif
                @endfor
              </td>
            </tr>
          @endif
        </table>

        @if($user->self_introduction !== null)
          <div class='userInfo_selfIntroduction pl-3 pr-3 mt-3'>
            <p class="font-weight-bold ">自己紹介</p>
            <p>
              {!! nl2br(e($user->self_introduction)) !!}
            </p>
          </div>
        @endif
        @if(Auth::id() === $user->id)
          <div class='userAction card-footer'>
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

        @if(Auth::id() !== $user->id)
          <div class="container position-fixed fixed-bottom row ml-auto mr-auto">
            <div class="col-4 text-center">
              <button type="button" class="bg-secondary circle_ui text-white text-nowrap rounded-pill disLike" data-reaction="{{$user->id}}">
                <i class="fas fa-heart-broken align-middle"></i>
              </button>
            </div>
            <div class="col-4 text-center">
              <button type="button" class="text-white bg-orgin circle_ui text-nowrap rounded-pill like" data-reaction="{{$user->id}}">
                <i class="fas fa-heart align-middle"></i>
              </button>
            </div>
            <div class="col-4 text-center">
              <button type="button" class="userActionModal" data-toggle="modal" data-target="#modal1">
                <span class="userActionModal_circle_dot"></span>
              </button>
            </div>
          </div>
          <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="label1">詳細メニュー</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  @foreach($user->fromUserId as $likefromuser)
                  @foreach($user->toUserId as $liketouser)
                    @if($likefromuser->to_user_id == Auth::id() && $liketouser->from_user_id == $user->id)
                      <div>
                        <h3 class="text-center h3">
                          両思い
                          {{$user->name}}さんから<br>好かれています。
                        </h3>
                        <h3 class="text-center h3">
                          <i class="fas fa-heart"></i>
                          <i class="fas fa-exchange-alt"></i>
                          <i class="far fa-smile"></i>
                        </h3>
                      </div>
                      @break
                    @elseif($likefromuser->to_user_id == Auth::id())
                      <div>
                        <h3 class="text-center h3">
                          {{$user->name}}さんから<br>好かれています。
                        </h3>
                        <h3 class="text-center h3">
                          <i class="fas fa-heart"></i>
                          <i class="fas fa-exchange-alt"></i>
                          <i class="far fa-smile"></i>
                        </h3>
                      </div>
                      @break
                    @endif
                  @endforeach
                  @endforeach
                  <div class="row justify-content-around">
                    <button type="button" class="bg-secondary circle_ui text-white text-nowrap rounded-pill disLike" data-reaction="{{$user->id}}">
                      <i class="fas fa-heart-broken align-middle"></i>
                    </button>
                    <button type="button" class="text-white bg-orgin circle_ui text-nowrap rounded-pill like" data-reaction="{{$user->id}}">
                      <i class="fas fa-heart align-middle"></i>
                    </button>
                  </div>
                </div>
                <div class="modal-footer justify-content-center">
                  <button class="btn btn-outline-dark reportbtn">通報について<i class="fas fa-chevron-left p-2"></i></button>
                </div>
                <div class="modal-body report_area">
                  <div class="form-controll">
                    <span class="text-danger error_report_level"></span>
                    <label class="form-check-label d-block p-2">
                      <input name="report" value="2" type="radio" class="report">
                      不適切な内容を含んでいる
                    </label>
                    <label class="form-check-label d-block p-2">
                      <input name="report" value="3" type="radio" class="report">
                      倫理的に問題がある可能性がある
                    </label>
                    <label class="form-check-label d-block p-2">
                      <input name="report" value="4" type="radio" class="report">
                      攻撃的または公序良俗に反している他のアカウントに被害が及ぶ可能性がある
                    </label>
                    <label class="form-check-label d-block p-2">
                      <input name="report" value="1" type="radio" class="report">
                      その他
                    </label>
                  </div>
                <div class="modal-body report_area  pl-0 pr-0">
                  <div class="form-group">
                    <label for="report_detail">具体的な通報内容</label>
                    <textarea id="report_detail" class="form-control"></textarea>
                    <span class="text-danger error_report_detail"></span>
                  </div>
                  <div class="modal-footer border-0">
                    <button type="button" id="submit_report" class="btn btn-outline-danger report_submit disabled" data-gender="{{$user->sex}}" data-report="{{$user->id}}">
                      通報する
                    </button>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">閉じる</button>
                </div>
              </div>
            </div>
          </div>
        @endif
      @elseif($user->reportFromUser->isEmpty() === false)
        <p class="pl-3 pr-3 mt-3">通報されたので見ることは出来ません。</p>
      @endif
      
    </div>
  </div>
</div>

@endsection
@section('script')
  @if( url()->previous() === url('') . '/register' )
    <script>window.alert('新規登録からのみアラート\n※最終的にモーダル出してプロフ入力に誘う')</script>
  @endif
  @if(Auth::id() !== $user->id)
  <script>
    	// ライクをクリック
	$(document).on('click', '.like', function() {
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

	// 通報処理
	$(document).on('click', '#submit_report', function() {
		const reportToUser = $(this);
		const reportToId = reportToUser.attr('data-report');
		var reportLevel = $('input:radio[name="report"]:checked').val();
		var checkedLevel = $('input:radio[name="report"]').on('change',function(){$(this).prop('checked');});
		var reportDetail = $('#report_detail').val();
    function levelCheck(reportLevel){
      if(checkedLevel !== false && reportLevel >= 1 && reportLevel <= 4 ){
        return true;
      }else{
        $('.error_report_level').text('理由を選択してください');
      }
    }
    function detailCheck(reportDetail){
      if(reportDetail.length >= 1 && reportDetail.length <= 200 ){
        return true;
      }else{
        $('.error_report_detail').text('通報理由の詳細を200字以内で入力してください。');
      }
    }
    if(levelCheck(reportLevel) === true && detailCheck( reportDetail ) === true){
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },//Headersを書き忘れるとエラーになる
        url: '/api/report',//ご自身のweb.phpのURLに合わせる
        type: 'POST',//リクエストタイプ
        data: {
          'to_user_id': reportToId,
          'from_user_id': {{ Auth::user()->id }},
          'report_level': reportLevel,
          'report_detail': reportDetail,
        },//Laravelに渡すデータ
      })
      // Ajaxリクエスト成功時の処理
      .done(function(data) {
        // Laravel内で処理された結果がdataに入って返ってくる
        console.log("成功");
        alert("通報が完了しました。\n一覧ページへ戻ります。");
        location.href = '{{ route('users.index') }}';
      })
      // Ajaxリクエスト失敗時の処理
      .fail(function(data) {
        alert('Ajaxリクエスト失敗');
      });
      
    }else{
      alert("入力内容に不備があります。\n正しく入力してください。");
    }
	});
  </script>
  @endif

@endsection
