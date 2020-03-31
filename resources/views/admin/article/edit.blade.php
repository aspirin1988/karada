@extends('admin.layouts.app')

@section('title')
    Karada - Article-Edit
@endsection

@section('content')
    @if(\Illuminate\Support\Facades\Auth::user()->siCorrector())
        <article_corrector_edit-component :id="{{$id}}"></article_corrector_edit-component>
    @else
        <article_edit-component :id="{{$id}}"></article_edit-component>
    @endif
@endsection
