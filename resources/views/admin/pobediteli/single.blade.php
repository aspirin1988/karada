@extends('admin.layouts.app')

@section('title')
    Karada - Pobediteli-Single
@endsection

@section('content')
    <pobediteli_single-component :id="{{$id}}"></pobediteli_single-component>
@endsection
