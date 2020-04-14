@extends('profile.app')

@section('styles')
    @parent
    <link rel="stylesheet" href="/css/courses.css?v=131">
@stop

@section('script')
    @parent
    <script src="/js/courses.js"></script>
@stop

@section('content')
    <div class="courses-main">
        <div class="courses-main-header">
            <div class="courses-main-title">
                pdf материалы
            </div>
        </div>
        <div class="lesson">
            <ul>
                @foreach($course->getAllPDF() as $pdf)
                    <li>
                        <a target="_blank" href="{{$pdf['url']}}" class="button button-gray-stroke round">
                            {{$pdf['name']}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <aside>
        <ul>
            @php $key =0; @endphp
            <li><a href="/home/course/{{$course->id}}/intro"><span>вступление</span></a></li>
            @foreach($course->getParentSection() as $key =>  $item)
                @if($child = $item->getChild() and  count($child))
                    <li class="parent {{(request()->getPathInfo()=="/home/course/".$course->id.'/'.$item->id?'open':'')}}">
                        <a href="/home/course/{{$course->id}}/{{$item->id}}"><span>{{($key+1)}}.</span><span>{{$item->title}}</span></a>
                        <ul>
                            @foreach($child as $key_ =>  $value)
                                @php $lessons = $value->getLesson() @endphp
                                <li class="{{(request()->getPathInfo()=="/home/course/".$course->id."/".$item->id || request()->getPathInfo()=="/home/course/".$course->id."/".$item->id."/".$value->id?'active':'')}}">
                                    <a href="/home/course/{{$course->id}}/{{$value->id}}">
                                        <span>{{$key+1}}.{{$key_+1}}.</span>
                                        <span>{{$value->title}}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <span class="parent-btn"></span>
                    </li>
                @else
                    <li><a href="/home/course/{{$course->id}}/{{$item->id}}"><span>{{($key+1)}}.</span><span>{{$item->title}}</span></a></li>
                @endif
            @endforeach
        </ul>
    </aside>

@endsection
