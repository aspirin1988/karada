@extends('admin.layouts.app')

@section('title')
    Karada - Help edit
@endsection

@section('content')
    <help_edit-component :id="{{$id}}"></help_edit-component>
@endsection
