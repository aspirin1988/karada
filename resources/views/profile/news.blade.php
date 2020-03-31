@extends('profile.app')

@section('content')
    <div class="container">
        <div class="news-grid">
            @foreach($news as $item)
                @if($item->type =='doc')
                    @php $doc = $item->getDoc() @endphp
                    <a href="{{$doc->url}}" target="_blank"
                       class="news-grid-item block {{(!$item->isSee()?"not-see":"")}}">
                        <div class="image">
                            <img src="/images/download.png" alt="">
                        </div>
                        <div class="text">
                            <div class="title">{{$item->title}}</div>
                            <div class="sub-title">{{$item->desacription}}</div>
                        </div>
                    </a>
                @else
                    <div class="news-grid-item block {{(!$item->isSee()?"not-see":"")}}" data-see="news:{{$item->id}}"
                         data-video-1080="{{$item->getVideoSize()}}" data-video-720="{{$item->getVideoSize(720)}}"
                         data-video-480="{{$item->getVideoSize(480)}}">
                        <div class="image">
                            <img src="{{$item->thumb}}" alt="">
                        </div>
                        <div class="text">
                            <div class="title">{{$item->title}}</div>
                            <div class="sub-title">{{$item->desacription}}</div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        {{ $news->links() }}
    </div>

@endsection
