@extends('admin.layouts.app')

@section('title')
    Karada - Certificate-List
@endsection

@section('content')
    @php $user_type = Auth::user()->type; @endphp
    <certificate_list-component :current_page="'{{$page}}'" :user_type="'{{$user_type}}'" ></certificate_list-component>
@endsection
