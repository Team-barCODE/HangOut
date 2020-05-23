<div class="row result_users">
    @if($status == 0)
        @foreach($users as $user)
            <div class="panel col-6 col-md-3 text-center mb-2">
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
                            <button type="button" class="btn btn-sm btn-secondary text-nowrap rounded-pill disLike" data-reaction="{{$user->id}}">嫌い</button>
                        </div>
                        <div class="p-2">
                            <button type="button" class="btn btn-sm btn-danger text-nowrap rounded-pill like" data-reaction="{{$user->id}}">好き</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        @foreach($users as $user)
            <div class="panel col-6 col-md-3 text-center mb-2">
                <a class="" href="/users/show/{{$user->to_user_id}}">
                    <img class="card-img-top image-circle under" alt="カードの画像" src="/storage/images/{{ $user->toUserId->img_name1 }}">
                </a>
                <div class="card card-body">
                    <h5 class="card-title">{{ $user->toUserId->name }}</h5>
                    <p class="badge badge-warning py-1">{{ $user->toUserId->prefecture }}</p>
                    @if(isset($user->toUserId->sex) && $user->toUserId->sex == 0)
                        <p class="card-text">性別：男</p>
                    @elseif(isset($user->toUserId->sex) && $user->toUserId->sex == 1)
                        <p class="card-text">性別：女</p>
                    @elseif(isset($user->toUserId->sex) && $user->toUserId->sex == 2)
                        <p class="card-text">性別：LGBT</p>
                    @endif

                    @if(isset($user->toUserId->self_introduction) && $user->toUserId->self_introduction != "")
                        <p class="card-text">{!! nl2br(e(Str::limit($user->toUserId->self_introduction, 60))) !!}</p>
                    @else
                        <p class="card-text">ユーザー詳細はありません</p>
                    @endif
                    <a class="card-link" href="/users/show/{{$user->toUserId->id}}">
                        続きを読む
                    </a>
                    <a href="#" class="btn btn-primary">ボタン</a>
                    <div class="d-flex justify-content-around">
                        <div class="p-2">
                            <button type="button" class="btn btn-sm btn-secondary text-nowrap rounded-pill disLike" data-reaction="{{$user->toUserId->id}}">嫌い</button>
                        </div>
                        <div class="p-2">
                            <button type="button" class="btn btn-sm btn-danger text-nowrap rounded-pill like" data-reaction="{{$user->toUserId->id}}">好き</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    <!-- {{$users->links()}} -->
</div>
