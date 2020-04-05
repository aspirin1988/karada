@extends('profile.app')

@section('content')
    <div class="container">
        <div class="personal_goals_section">
            <div class="personal_goals_header">
                @if($video)
                    <div class="block motivation">
                        <img width="100%" src="{{$video->thumb}}" alt="">
                        <div>
                            <span class="title">{{$video_title}}</span>
                            <a href="#" data-video-1080="{{$video->getVideoSize()}}"
                               data-video-720="{{$video->getVideoSize(720)}}"
                               data-video-480="{{$video->getVideoSize(480)}}"
                               class="button round button-yellow-stroke ">смотреть
                                ролик</a>
                        </div>
                    </div>
                @endif
                <div class="block add-goals">
                    <div class="img"></div>
                    <div class="title">добавить новую цель</div>
                </div>
            </div>
            <div class="personal_goals_body">
                <ul class="goals-tabs">
                    <li class="{{($method =='in-process'?'active':"")}}"><a href="/home/personal_goals/in-process/">в
                            процессе</a><span>{{$personal_goals_in_process_count}}</span></li>
                    <li class="{{($method =='complete'?'active':"")}}"><a href="/home/personal_goals/complete/">выполнено</a><span>{{$personal_goals_complete_count}}</span>
                    </li>
                    <li class="{{($method =='failed'?'active':"")}}"><a href="/home/personal_goals/failed/">не выполнено</a><span>{{$personal_goals_failed_count}}</span></li>
                </ul>
                <ul class="goals-tabs-switch">
                    <li class="{{($method =='in-process'?'active':"")}}">
                        <div class="personal_goals_body_grid">
                            @foreach($personal_goals_in_process as $in_process)
                                <div class="personal_goals_body_grid_item block in-process">
                                    <img src="{{$in_process->image??'/img/empty.png'}}" alt="">
                                    <div class="data">
                                        <div>
                                            <div class="title">{{$in_process->description}}</div>
                                        </div>
                                        <div>
                                            <div class="sub-title">Дата выполнения:</div>
                                            <div class="date">{{$in_process->date_end}}</div>
                                            <div class="button-group">
                                                <goals-approve-component
                                                    :id="'{{$in_process->id}}'"
                                                    :image="'{{$in_process->image??'/img/empty.png'}}'"></goals-approve-component>
                                                <goals-edit-component :key="{{$in_process->id}}" :id="'{{$in_process->id}}'"></goals-edit-component>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if($personal_goals_in_process)
                            {{ $personal_goals_in_process->links() }}
                        @endif
                    </li>
                    <li class="{{($method =='complete'?'active':"")}}">
                        <div class="personal_goals_body_grid">
                            @foreach($personal_goals_complete as $complete)
                                <div class="personal_goals_body_grid_item block complete">
                                    <img src="{{$complete->image??'/img/empty.png'}}" alt="">
                                    <div class="data">
                                        <div class="title">{{$complete->description}}</div>
                                        <div class="sub-title">Дата выполнения:</div>
                                        <div class="date">{{$complete->date_end}}</div>
                                        <span class="status">Выполнено!</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if($personal_goals_complete)
                            {{ $personal_goals_complete->links() }}
                        @endif
                    </li>
                    <li class="{{($method =='failed'?'active':"")}}">
                        <div class="personal_goals_body_grid">
                            @foreach($personal_goals_failed as $key => $failed)
                                <div class="personal_goals_body_grid_item block failed">
                                    <img src="{{$failed->image??'/img/empty.png'}}" alt="">
                                    <div class="data">
                                        <div class="title">{{$failed->description}}</div>
                                        <div class="sub-title">Дата выполнения:</div>
                                        <div class="date">{{$failed->date_end}}</div>
                                        <span class="status">Не выполнено!</span>
                                        {{--                                        <a href="#" class="button round button-blue-stroke ">--}}
                                        {{--                                            <img src="/images/check.png" alt="">сделано!--}}
                                        {{--                                        </a>--}}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if($personal_goals_failed)
                            {{ $personal_goals_failed->links() }}
                        @endif
                    </li>
                </ul>
            </div>
        </div>
        <div class="offcanvas" rel="personal_goals_add_model">
            <div class="overlay"></div>
            <personal_goals_add_model></personal_goals_add_model>
        </div>
    </div>
@endsection
