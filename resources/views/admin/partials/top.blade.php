<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Azuf Dashboard</title>
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/admin/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/data-table/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/main.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/toastr/build/toastr.min.css')}}">
    <meta name="csrf-token" content="{{csrf_token()}}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
