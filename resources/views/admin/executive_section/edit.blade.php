@extends('admin.layouts.app')

@section('title')
    Karada - Motivation edit
@endsection

@section('content')
    <motivation_edit-component :id="{{$id}}"></motivation_edit-component>
@endsection
