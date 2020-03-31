@extends('admin.layouts.app')

@section('title')
    Karada - News edit
@endsection

@section('content')
    <news_edit-component :id="{{$id}}"></news_edit-component>
@endsection
