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

                    @foreach($user->fromUserId as $reaction)
                        @if($reaction->to_user_id == $auth_id && $reaction->status == 1)
                            <div class="text-danger">ライクされています</div>
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
    @elseif($status == 3)
        @foreach($users as $user)
            <div class="panel col-6 col-md-3 text-center mb-2">
                <a class="" href="/users/show/{{$user->to_user_id}}">
                    <img class="card-img-top image-circle under" alt="カードの画像" src="/storage/images/{{ $user->fromUserId->img_name1 }}">
                </a>
                <div class="card card-body">
                    <h5 class="card-title">{{ $user->fromUserId->name }}</h5>
                    <p class="badge badge-warning py-1">{{ $user->fromUserId->prefecture }}</p>
                    @if(isset($user->fromUserId->sex) && $user->fromUserId->sex == 0)
                        <p class="card-text">性別：男</p>
                    @elseif(isset($user->fromUserId->sex) && $user->fromUserId->sex == 1)
                        <p class="card-text">性別：女</p>
                    @elseif(isset($user->fromUserId->sex) && $user->fromUserId->sex == 2)
                        <p class="card-text">性別：LGBT</p>
                    @endif

                    @if(isset($user->fromUserId->self_introduction) && $user->fromUserId->self_introduction != "")
                        <p class="card-text">{!! nl2br(e(Str::limit($user->fromUserId->self_introduction, 60))) !!}</p>
                    @else
                        <p class="card-text">ユーザー詳細はありません</p>
                    @endif
                    <a class="card-link" href="/users/show/{{$user->fromUserId->id}}">
                        続きを読む
                    </a>


                    <div>自分のID：{{ $me->id }}</div>
                    <div>この人のID：{{ $user->fromUserId->id }}</div>
                    @foreach($me->fromUserId as $liked)
                        @if($liked->to_user_id == $user->fromUserId->id && $liked->status == 1)
                            <div class="text-danger">両想いです</div>
                        @endif
                    @endforeach
                    @if($user->toUserId->id == $auth_id)
                        <div class="text-danger">ライクされています</div>
                    @endif


                    <a href="#" class="btn btn-primary">ボタン</a>
                    <div class="d-flex justify-content-around">
                        <div class="p-2">
                            <button type="button" class="btn btn-sm btn-secondary text-nowrap rounded-pill disLike" data-reaction="{{$user->fromUserId->id}}">嫌い</button>
                        </div>
                        <div class="p-2">
                            <button type="button" class="btn btn-sm btn-danger text-nowrap rounded-pill like" data-reaction="{{$user->fromUserId->id}}">好き</button>
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

                    <div>自分のID：{{ $me->id }}</div>
                    <div>この人のID：{{ $user->toUserId->id }}</div>

                    @foreach($user->fromUserId->toUserId as $reaction)
                        @if($reaction->from_user_id == $user->toUserId->id && $reaction->status == 1)
                            @foreach($me->fromUserId as $liked)
                                @if($liked->to_user_id == $user->toUserId->id && $liked->status == 1)
                                    <div class="text-danger">両想いです</div>
                                @endif
                            @endforeach
                            <div class="text-danger">ライクされています</div>
                        @endif
                    @endforeach

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
