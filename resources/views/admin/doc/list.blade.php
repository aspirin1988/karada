@extends('admin.layouts.app')

@section('title')
    Karada - Doc list
@endsection

@section('content')
    @php $user_type = Auth::user()->type; @endphp
    <doc_list-component :user_type="'{{$user_type}}'" :current_page="{{$page}}"></doc_list-component>
@endsection
