@extends('admin.layouts.app')

@section('title')
    Karada - CourseBonus edit
@endsection

@section('content')
    <course_bonus_edit-component :id="{{$id}}"></course_bonus_edit-component>
@endsection
