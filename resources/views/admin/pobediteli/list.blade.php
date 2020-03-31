@extends('admin.layouts.app')

@section('title')
    Karada - Pobediteli-List
@endsection

@section('content')
    <pobediteli_list-component :method="'{{$method}}'" :current_page="{{$page}}"></pobediteli_list-component>
@endsection
