@extends('adminlte::page')

@section('title', '管理画面')
@section('dashboard_url', route('admin.home'))
@section('logout_url', route('admin.logout'))

@section('content_header')
    <h1>管理画面</h1>
@stop

@section('content')

  <table class="table table-striped table-responsive">
    <tr>
      <th class="text-nowrap">通報されたID</th>
      <th class="text-nowrap">通報された件数</th>
      <th class="text-nowrap">BANボタン</th>
    </tr>
    @foreach($reportedUsers as $users)
      <tr>
        <td>
          <a class="btn btn-primary" href="/admin/report/{{$users->to_user_id}}">
            {{$users->to_user_id}}
          </a>
        </td>
        <td>{{$users->where('to_user_id',$users->to_user_id)->count()}}</td>
        <td><button class="btn btn-outline-danger" data-ban="{{$users->to_user_id}}">BAN</button></td>
      </tr>
    @endforeach
  </table>
  <div class="row justify-content-center">
    {{$reportedUsers->links()}}
  </div>

@stop


@section('js')
    <script> console.log('Hi!'); </script>
@stop