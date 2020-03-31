@extends('admin.layouts.app')

@section('title')
    Karada - Section
@endsection

@section('content')
    @php $user_type = Auth::user()->type; @endphp
    <section-component :user_type="'{{$user_type}}'"></section-component>
@endsection
