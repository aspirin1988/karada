@extends('admin.layouts.app')

@section('title')
    Karada - motivation list
@endsection

@section('content')
    @php $user_type = Auth::user()->type; @endphp
    <motivation_list-component :user_type="'{{$user_type}}'" :current_page="{{$page}}"></motivation_list-component>
@endsection
