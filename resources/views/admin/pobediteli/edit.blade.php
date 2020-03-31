@extends('admin.layouts.app')

@section('title')
    Karada - Pobediteli-Edit
@endsection

@section('content')
    <pobediteli_edit-component :id="{{$id}}"></pobediteli_edit-component>
@endsection
