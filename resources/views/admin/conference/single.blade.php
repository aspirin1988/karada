@extends('admin.layouts.app')

@section('title')
    Karada - Conference-Single
@endsection

@section('content')
    <conference_single-component :id="{{$id}}"></conference_single-component>
@endsection
