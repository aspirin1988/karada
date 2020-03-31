@extends('admin.layouts.app')

@section('title')
    Karada - Course-Edit
@endsection

@section('content')
    @php $user_type = Auth::user()->type; @endphp
    <courses-edit-component :user_type="'{{$user_type}}'" :id="'{{$id}}'"></courses-edit-component>
@endsection
