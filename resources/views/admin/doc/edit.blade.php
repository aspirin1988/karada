@extends('admin.layouts.app')

@section('title')
    Karada - Doc edit
@endsection

@section('content')
    <doc_edit-component :id="{{$id}}"></doc_edit-component>
@endsection
