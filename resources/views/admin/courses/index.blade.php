@extends('admin.layouts.app')

@section('title')
    Karada - Courses
@endsection

@section('content')
    @php $user_type = Auth::user()->type; @endphp
    <courses-component :user_type="'{{$user_type}}'"></courses-component>
@endsection
