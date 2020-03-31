@extends('admin.layouts.app')

@section('title')
    Karada - Feedback-Edit
@endsection

@section('content')
    <feedback_edit-component :id="{{$id}}"></feedback_edit-component>
@endsection
