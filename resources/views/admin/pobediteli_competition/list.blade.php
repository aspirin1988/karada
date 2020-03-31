@extends('admin.layouts.app')

@section('title')
    Karada - PobediteliCompetition-List
@endsection

@section('content')
    <pobediteli_competition_list-component :method="'{{$method}}'" :current_page="{{$page}}"></pobediteli_competition_list-component>
@endsection
