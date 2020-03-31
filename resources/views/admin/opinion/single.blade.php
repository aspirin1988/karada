@extends('admin.layouts.app')

@section('title')
    Karada - Opinion-Single
@endsection

@section('content')
    <opinion_single-component :id="{{$id}}"></opinion_single-component>
@endsection
