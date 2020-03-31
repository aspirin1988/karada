@extends('admin.layouts.app')

@section('title')
    Karada - Section-Edit
@endsection

@section('content')
    <section-edit-component :id="'{{$id}}'"></section-edit-component>
@endsection
