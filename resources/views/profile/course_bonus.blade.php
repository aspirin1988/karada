@extends('profile.app')

@section('content')
    <div class="container">
        <div class="news-grid">
            @foreach($news as $item)
                @if($item->type == 'video')
                    <div class="news-grid-item block" data-video-1080="{{$item->getVideoSize()}}"
                         data-video-720="{{$item->getVideoSize(720)}}" data-video-480="{{$item->getVideoSize(480)}}">
                        <div class="image">
                            <img src="{{$item->getThumb()}}" alt="">
                        </div>
                        <div class="text">
                            <div class="title">{{$item->title}}</div>
                            <div class="sub-title">{{$item->desacription}}</div>
                        </div>
                    </div>
                @endif
                @if($item->type == 'doc')
                        <a href="{{$item->getDocUlr()}}" class="news-grid-item block">
                            <div class="image">
                                <img src="/images/download.png" alt="">
                            </div>
                            <div class="text">
                                <div class="title">{{$item->title}}</div>
                                <div class="sub-title">{{$item->desacription}}</div>
                            </div>
                        </a>
                @endif
            @endforeach
        </div>
        {{ $news->links() }}
    </div>

@endsection
