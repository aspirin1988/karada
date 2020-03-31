@extends('admin.layouts.app')

@section('title')
    Karada - Lesson-Edit
@endsection

@section('content')
    @php $user_type = Auth::user()->type; @endphp
    <lesson-edit-component :user_type="'{{$user_type}}'" :id="'{{$id}}'"></lesson-edit-component>
@endsection
