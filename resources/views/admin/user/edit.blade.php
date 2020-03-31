@extends('admin.layouts.app')

@section('title')
    Karada - User-Edit
@endsection

@section('content')
    @php $user_type = Auth::user()->type; @endphp
    <user_edit-component :user_type="'{{$user_type}}'"  :id="{{$id}}"></user_edit-component>
@endsection
