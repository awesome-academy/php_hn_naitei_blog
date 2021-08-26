@extends('homepage.app')

@section('content')
    <section>
        <div class="gap2 gray-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row merged20" id="page-contents">
                            <div class="col-lg-12">
                                <div class="central-meta item">
                                    <div class="user-post">
                                        <div class="friend-info">
                                            <figure>
                                                @foreach ($user->images as $image)
                                                    <img src="{{ asset($image->image_url) }}" alt="">
                                                @endforeach
                                            </figure>
                                            <div class="friend-name">
                                                <div class="more">
                                                    <div class="more-post-optns"><i class="ti-more-alt"></i>
                                                        <ul>
                                                            <li><a href="{{route('stories.edit', $story->id)}}"><i class="fa fa-pencil-square-o"></i>{{ trans('homepage.edit_post') }}</a></li>
                                                            <li>
                                                                <form action="{{ route('stories.destroy', $story->id)}}" method="Post">
                                                                    @method('Delete')
                                                                    @csrf
                                                                    <button class="btn-danger" onclick="return confirm('Are you sure ?')">{{ trans('homepage.delete_post') }}</button>
                                                                </form> 
                                                            </li>
                                                            <li><i class="fa fa-bell-slash-o"></i>{{ trans('homepage.bookmark') }}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <ins><a href="time-line.html" title="">{{ $story->user->username }}</a></ins>
                                                <span>{{$story->status }}: {{ $story->created_at}}</span>
                                            </div>
                                            <div class="post-meta">
                                                @if(count($story->images) > 0)
                                                    <figure>
                                                        @if(count($story->images) == 1) 
                                                            <img src="{{ asset( $story->images[0]->image_url ) }}" >
                                                        @endif
                                                        @if(count($story->images) > 1)
                                                            <div id="demo"  class="carousel slide row"  data-ride="carousel"> 
                                                                <div class="carousel-inner col-12" >
                                                                    <div class="carousel-item active">
                                                                        <img src="{{ asset( $story->images[0]->image_url ) }}" >
                                                                    </div>
                                                                    {{ $k=1 }}
                                                                    @while ($k < count($story->images))
                                                                        <div class="carousel-item ">
                                                                            <img src="{{ asset( $story->images[$k]->image_url ) }}" >
                                                                        </div>
                                                                        {{ $k++ }}
                                                                    @endwhile
                                                                </div>
                                                                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                                                    <span class="carousel-control-prev-icon"></span>
                                                                </a>
                                                                <a class="carousel-control-next" href="#demo" data-slide="next">
                                                                    <span class="carousel-control-next-icon"></span>
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </figure>	
                                                @endif	
                                                <div class="description">
                                                    <a href="{{ route('stories.show', [$story->id]) }}"><h6> {{ $story->title }}</h6></a><br>
                                                    <p>{{ $story->content }}</p>
                                                </div>
                                                <div class="we-video-info">
                                                    <ul>
                                                        <li>
                                                            <div class="likes heart" title="Like/Dislike">❤ <span>{{ $story->total_like }}</span></div>
                                                        </li>
                                                        <li>
                                                            <span class="comment" title="Comments">
                                                                <i class="fa fa-commenting"></i>
                                                                <ins>{{ $story->total_comment }}</ins>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>	
                                            </div>
                                            <div class="coment-area" style="display: block">
                                                <ul class="we-comet">
                                                    @foreach($story->comments as $comment)
                                                        <li>
                                                            <div class="comet-avatar">
                                                                @foreach ($comment->user->images as $image)
                                                                    <img src="{{ asset($image->image_url) }}" alt="">
                                                                @endforeach
                                                            </div>
                                                            <div class="we-comment">
                                                                <h5><a href="#" title="">{{ $comment->user->username }}</a></h5>
                                                                <p>{{ $comment->content }}</p>
                                                                <div class="inline-itms">
                                                                    <span>{{ $comment->created_at}}</span>
                                                                    <a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                    <li class="post-comment">
                                                        <div class="post-comt-box">
                                                            <form method="post">
                                                                <textarea name="comment"></textarea>
                                                                <button type="submit"></button>
                                                            </form>	
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>	
                        </div>
                    </div>
                </div>
            </div>	
        </div>
    </section>

@endsection
