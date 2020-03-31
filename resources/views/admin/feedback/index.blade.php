@extends('admin.layouts.app')

@section('title')
    Karada - Feedback-List
@endsection

@section('content')
    <feedback_list-component :current_page="{{$page}}" ></feedback_list-component>
@endsection
