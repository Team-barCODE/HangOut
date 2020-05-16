<header class="header">
    <ul class="list-group-horizontal nav align-items-center justify-content-around">
        @if((Auth::id() !== null))

            <li class="col-5 mb-2 mt-2 text-center">
                <a href="/users/show/{{Auth::id()}}">
                    <i class="fas fa-user fa-2x"></i>
                </a>
            </li>
        @endif

        <li class="col-2 mb-2 mt-2 text-center">
            @if((Auth::id() !== null))
                <a class="" href="{{route('home')}}">
            @else
                <a class="" href="{{url('/')}}">
            @endif
                    <img class="home_icon" src="/storage/images/techpit-match-icon.png">
                </a>
        </li>
        @if((Auth::id() !== null))

        <li class="col-5 mb-2 mt-2 text-center">
            <nav>
                <button class="hamburgeranime">
                    <span class="first"></span>
                    <span class="second"></span>
                    <span class="third"></span>
                </button>
            </nav>
        </li>
        @endif
    </ul>
    <nav class="gnavi-contents m-0">
      <ul class="row align-items-center justify-content-around p-0 m-0">
          <li class="list_none mt-2 mb-2 col-md-2">
              <a class="btn btn-sm btn-primary d-block" href="/users/show/{{Auth::id()}}">マイページ</a>
          </li>
          <li class="list_none mt-2 mb-2 col-md-2">
              <a class="btn btn-sm btn-primary d-block"  href="{{ route('home') }}">スワイプ</a>
          </li>
          <li class="list_none mt-2 mb-2 col-md-2">
              <a class="btn btn-sm btn-primary d-block" href="{{ route('users.index') }}">一覧</a>
          </li>
          <li class="list_none mt-2 mb-2 col-md-2">
              <a class="btn btn-sm btn-primary d-block" href="{{ route('matching') }}">チャット</a>
          </li>
          <li class="list_none mt-2 mb-2 col-md-2">
              <a class="btn btn-sm btn-primary d-block" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">ログアウト</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
          </li>
      </ul>
    </nav>


</header>
