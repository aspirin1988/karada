@extends('admin.layouts.app')

@section('title')
    Karada - Lesson
@endsection

@section('content')
    @php $user_type = Auth::user()->type; @endphp
    <lesson-component :user_type="'{{$user_type}}'" :current_page="{{$page}}" ></lesson-component>
@endsection
