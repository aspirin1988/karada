@extends('admin.layouts.app')

@section('title')
    Karada - Member-Edit
@endsection

@section('content')
    <member_edit-component :id="{{$id}}"></member_edit-component>
@endsection
