@extends('admin.layouts.app')

@section('title')
    Karada - Conference-Edit
@endsection

@section('content')
    <conference_question_edit-component :id="{{$id}}" :question_id="{{$question_id}}"></conference_question_edit-component>
@endsection
