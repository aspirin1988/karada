@extends('profile.app')

@section('styles')
    @parent
    <link rel="stylesheet" href="/css/courses.css?v=140">
    <style>
        #app {
            display: grid;
            grid-template-columns: 400px calc(100% - 400px);
            background-color: white;
            margin-top: 70px;
        }

        @media (max-width: 640px) {
            #app {
                grid-template-columns: 100%;
                margin-top: 65px;
            }
        }
        @media (min-width: 641px) and (max-width: 799px) {
            #app {
                grid-template-columns: 100%;
                margin-top: 65px;
            }
        }
        @media (min-width: 800px) and (max-width: 1199px) {
            #app {
                grid-template-columns: 100%;
                margin-top: 65px;
            }
        }

        .courses-main {
            margin: 0;
        }

        aside {
            position: relative;
            order: -1;
            left: 0;
            top: 0;
            height: 100%;
        }

        footer {
            margin-top: 0;
        }

        .accordion-content{
            height: 0;
            overflow: hidden;
        }
        .accordion-content.active{
            height:  auto;
        }
        #open_accordion img{
            transform: rotateZ(180deg);
        }
        #open_accordion.active img{
            transform: rotateZ(0deg);
        }
    </style>

@stop

@section('script')
    @parent
    <script src="/js/courses.js"></script>
    <script>
        let open_accordion = document.querySelector('#open_accordion');
        let accordion_content = document.querySelector('.accordion-content');
        open_accordion.addEventListener('click',function () {
            accordion_content.classList.toggle('active');
            open_accordion.classList.toggle('active');
        });
        window.addEventListener('load',function () {
            if(screen.width < 768) {
                let app = document.querySelector('#app');
                let nav = document.querySelector('header');
                app.style.marginTop = nav.clientHeight+'px';
            }
            let open_ = document.querySelector('.accordion-content .parent.open');
            let ul = document.querySelector('.accordion-content .parent.open ul');
            ul.style.height=ul.scrollHeight+'px';
        });
    </script>
@stop

@section('content')
    <div class="courses-main">
        <div class="courses-main-header"
             style="background: #000 url({{$course->getThumbCategory()}}) no-repeat left bottom/cover;">
            <div class="courses-main-title">
                {{$course->title}}
            </div>
        </div>
        <div class="courses-main-grid">
            @foreach($course->getParentSection() as $item)
                <a href="{{$item->getUrl()}}" class="courses-main-grid-item"
                   style="background-image: url('{{$item->getThumb()}}')">
                </a>
            @endforeach
        </div>
    </div>
    <aside>
        <ul class="hidden-mobile">
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
                                        <span>{{$key+1}}.{{$key_+1}}.</span><span>{{$value->title}}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <span class="parent-btn"></span>
                    </li>
                @else
                    <li>
                        <a href="/home/course/{{$course->id}}/{{$item->id}}"><span>{{($key+1)}}.</span><span>{{$item->title}}</span></a>
                    </li>
                @endif
            @endforeach
        </ul>
        <ul class="visible-mobile">
            <li><a href="#" id="open_accordion" >
                    <img src="/images/menu_icon.svg" style="margin-right: 15px" alt="">Каталог разделов <img style="width: 20px; height: 13px; float: right; position: absolute; right: 10px; top: 20px;" src="/images/collapse_button.png" alt=""></a> </li>
            <ul class="accordion-content">
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
                                            <span>{{$key+1}}.{{$key_+1}}.</span><span>{{$value->title}}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <span class="parent-btn"></span>
                        </li>
                    @else
                        <li>
                            <a href="/home/course/{{$course->id}}/{{$item->id}}"><span>{{($key+1)}}.</span><span>{{$item->title}}</span></a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </ul>
    </aside>
@endsection
