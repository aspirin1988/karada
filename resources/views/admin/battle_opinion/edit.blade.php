@extends('admin.layouts.app')

@section('title')
    Karada - Article-Edit
@endsection

@section('content')
    @if(\Illuminate\Support\Facades\Auth::user()->siCorrector())
        <battle_opinion_corrector_edit-component :id="{{$id}}"></battle_opinion_corrector_edit-component>
    @else
        <battle_opinion_edit-component :id="{{$id}}"></battle_opinion_edit-component>
    @endif
@endsection
