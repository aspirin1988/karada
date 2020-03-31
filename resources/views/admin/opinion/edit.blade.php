@extends('admin.layouts.app')

@section('title')
    Karada - Opinion-Edit
@endsection

@section('content')
    <opinion_edit-component :id="{{$id}}"></opinion_edit-component>
@endsection
