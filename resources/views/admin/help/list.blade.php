@extends('admin.layouts.app')

@section('title')
    Karada - Help list
@endsection

@section('content')
    @php $user_type = Auth::user()->type; @endphp
    <help_list-component :user_type="'{{$user_type}}'" ></help_list-component>
@endsection
