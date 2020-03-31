@extends('admin.layouts.app')

@section('title')
    Karada - PobediteliCompetition-Edit
@endsection

@section('content')
    <pobediteli_competition_edit-component :id="{{$id}}"></pobediteli_competition_edit-component>
@endsection
