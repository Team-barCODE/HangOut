@extends('adminlte::page')

@section('title', '管理画面')
@section('dashboard_url', route('admin.home'))
@section('dashboard_url', route('admin.logout'))

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@stop

@section('css')
    <link rel="stylesheet" href="admin-lte/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop