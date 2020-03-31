@extends('admin.layouts.app')

@section('title')
    Karada - PobediteliVideo-List
@endsection

@section('content')
    <pobediteli_video_list-component :method="'{{$method}}'" :current_page="{{$page}}"></pobediteli_video_list-component>
@endsection
