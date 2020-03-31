@extends('admin.layouts.app')

@section('title')
    Karada - Gallery-Edit
@endsection

@section('content')
    @if(\Illuminate\Support\Facades\Auth::user()->siCorrector())
        <gallery_corrector_edit-component :id="{{$id}}"></gallery_corrector_edit-component>
    @else
        <gallery_edit-component :id="{{$id}}"></gallery_edit-component>
    @endif
@endsection
