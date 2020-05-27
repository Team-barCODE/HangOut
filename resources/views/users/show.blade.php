@extends('layouts.layout')

@section('content')

<div class='usershowPage'>
  <div class='container pt-4'>
    <div class='userInfo card'>
      <div class='userInfo_name card-header mt-0'>{{ $user->name }}</div>
      <div class='userInfo_img'>
        <img src="/storage/images/{{$user ->img_name1}}">
      </div>
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
        @if(count($user->genreId) !== 0)
          <tr>
            <th class="text-nowrap">趣味</th>
            <td>
              @foreach($hobbies as $hobby)
                @foreach($user->genreId as $myhobby)
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
        @if(count($user->personalityId) !== 0)
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
        @if(count($user->jobId) !== 0)
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
              @for($i = 0 ; $i <= count($income)-1 ; $i++ )
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
    </div>


  </div>
</div>

@endsection
@section('script')
  @if( url()->previous() === url('') . '/register' )
    <script>window.alert('新規登録からのみアラート\n※最終的にモーダル出してプロフ入力に誘う')</script>
  @endif
@endsection
