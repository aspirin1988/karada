@extends('profile.app')

@section('styles')
    @parent
    <link rel="stylesheet" href="/css/courses.css?v=118">

@stop

@section('content')
    <div class="container">
        <div class="courses-grid">
            <a href="/home/course/1" class="courses-grid-item" style="background-image: url('/images/corporate-marketing.png');">

            </a>
            <a href="/home/course/2" class="courses-grid-item" style="background-image: url('/images/kak_uvelichit_prodazhi.png');">

            </a>
{{--            <a href="/home/course_bonus" class="courses-grid-item" style="background-image: url('/images/bonus.png'); background-position: top center">--}}

{{--            </a>--}}
        </div>
    </div>
@endsection
