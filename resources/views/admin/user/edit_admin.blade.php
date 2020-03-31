@extends('admin.layouts.app')

@section('title')
    Karada - User-Edit
@endsection

@section('content')
    <user_edit_admin-component :id="{{$id}}"></user_edit_admin-component>
@endsection
