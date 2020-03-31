@extends('admin.layouts.app')

@section('title')
    Karada - Video list
@endsection

@section('content')
    @php $user_type = Auth::user()->type; @endphp
    <video_list-component :user_type="'{{$user_type}}'" :method="'{{$method}}'" :current_page="{{$page}}"></video_list-component>
@endsection
