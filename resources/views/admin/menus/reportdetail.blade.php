@extends('adminlte::page')
@section('css')
    <link rel="stylesheet" href="admin-lte/css/admin_custom.css">
@stop

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
      <th class="text-nowrap">通報したID</th>
      <th>通報内容</th>
      <th class="text-nowrap">BANボタン</th>
    </tr>
    @foreach($users as $user)
      <tr>
        <td>
          <a href="/{{$user->to_user_id}}/report">
            {{$user->to_user_id}}

          </a>
        </td>
        <td>{{$user->from_user_id}}</td>
        <td class="text-wrap w-100">{{$user->report_detail}}</td>
        <td><button class="btn btn-outline-danger" data-ban="{{$user->to_user_id}}">BAN</button></td>
      </tr>
    @endforeach
  </table>
  <div class="row justify-content-center">
    {{$users->links()}}

  </div>

@stop


@section('js')
    <script> console.log('Hi!'); </script>
@stop