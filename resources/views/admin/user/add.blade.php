@extends('admin.layouts.app')

@section('title')
    Karada - User-Add
@endsection

@section('content')
    @php $user_type = Auth::user()->type; @endphp
    <user_add-component :manager_type="'{{$user_type}}'" :user_type="'{{$method}}'"></user_add-component>
@endsection
