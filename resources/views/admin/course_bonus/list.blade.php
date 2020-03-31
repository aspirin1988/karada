@extends('admin.layouts.app')

@section('title')
    Karada - CourseBonus list
@endsection

@section('content')
    @php $user_type = Auth::user()->type; @endphp
    <course_bonus_list-component :user_type="'{{$user_type}}'" :current_page="'{{$page}}'" ></course_bonus_list-component>
@endsection
