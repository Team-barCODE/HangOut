@extends('adminlte::page')
@section('css')
    <link rel="stylesheet" href="admin-lte/css/admin_custom.css">
@stop

@section('title', '管理画面')
@section('dashboard_url', route('admin.home'))
@section('logout_url', route('admin.logout'))

@section('content_header')
    <h1>管理画面</h1>
    <p class="mt-4">{{$authUser->name}}さん、管理画面へようこそ。</p>
@stop

@section('content')


@stop


@section('js')
    <script> console.log('Hi!'); </script>
@stop