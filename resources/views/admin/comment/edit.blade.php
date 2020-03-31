@extends('admin.layouts.app')

@section('title')
    Karada - Comment-Edit
@endsection

@section('content')
    <comment_edit-component :id="{{$id}}"></comment_edit-component>
@endsection
