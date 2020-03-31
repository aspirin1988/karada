@extends('admin.layouts.app')

@section('title')
    Karada - Comment-Single
@endsection

@section('content')
    <comment_single-component :id="{{$id}}"></comment_single-component>
@endsection
