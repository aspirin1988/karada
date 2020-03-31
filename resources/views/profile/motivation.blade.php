@extends('profile.app')

@section('content')
    <div class="container">
        <div class="motivation-grid">
            @foreach($motivations as $item)
                <div class="motivation-grid-item block {{(!$item->isSee()?"not-see":"")}} " data-see="motivation:{{$item->id}}" data-video-1080="{{$item->getVideoSize()}}" data-video-720="{{$item->getVideoSize(720)}}" data-video-480="{{$item->getVideoSize(480)}}">
                    <div class="image">
                        <img src="{{$item->thumb}}" alt="">
                    </div>
                    <a href="#" class="title">{{$item->title}}</a>
                </div>
            @endforeach
        </div>
        {{ $motivations->links() }}
        <div class="offcanvas" rel="news">
            <div class="overlay"></div>
            <div class="center-center">
                <div class="block modal-body">
                    <div class="video-container">
                        <video controls="controls" src="" controlsList="nodownload"></video>
                        <div class="overlay-video">
                            <ul  >
                                <li class="active"><span data-size="">1080p</span></li>
                                <li><span data-size="">720p</span></li>
                                <li><span data-size="">480p</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
