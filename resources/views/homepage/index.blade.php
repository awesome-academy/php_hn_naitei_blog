@extends('homepage.app')

@section('content')
<section>
    <div class="gap2 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row merged20" id="page-contents">
                        <div class="col-lg-3">
                            <aside class="sidebar static left">
                                <div class="widget">
                                    <div class="weather-widget low-opacity bluesh">
                                        <div class="bg-image" ></div>
                                        <span class="refresh-content"><i class="fa fa-refresh"></i></span>
                                        <div class="weather-week">
                                            <div class="icon sun-shower">
                                                <div class="cloud"></div>
                                                <div class="sun">
                                                    <div class="rays"></div>
                                                </div>
                                                <div class="rain"></div>
                                            </div>
                                        </div>
                                        <div class="weather-infos">
                                            <span class="weather-tem">25</span>
                                            <h3>{{ trans('homepage.cloudy') }}</h3>
                                            <div class="weather-date skyblue-bg">
                                                <span>{{ trans('homepage.may') }}<strong>21</strong></span>
                                            </div>
                                        </div>
                                        <div class="monthly-weather">
                                            <ul>
                                                <li>
                                                    <span>{{ trans('homepage.sun') }}</span>
                                                    <a href="#" title=""><i class="wi wi-day-sunny"></i></a>
                                                    <em>40°</em>
                                                </li>
                                                <li>
                                                    <span>{{ trans('homepage.mon') }}</span>
                                                    <a href="#" title=""><i class="wi wi-day-cloudy"></i></a>
                                                    <em>10°</em>
                                                </li>
                                                <li>
                                                    <span>{{ trans('homepage.tue') }}</span>
                                                    <a href="#" title=""><i class="wi wi-day-hail"></i></a>
                                                    <em>20°</em>
                                                </li>
                                                <li>
                                                    <span>{{ trans('homepage.web') }}</span>
                                                    <a href="#" title=""><i class="wi wi-day-lightning"></i></a>
                                                    <em>34°</em>
                                                </li>
                                                <li>
                                                    <span>{{ trans('homepage.thu') }}</span>
                                                    <a href="#" title=""><i class="wi wi-day-showers"></i></a>
                                                    <em>22°</em>
                                                </li>
                                                <li>
                                                    <span>{{ trans('homepage.fri') }}</span>
                                                    <a href="#" title=""><i class="wi wi-day-windy"></i></a>
                                                    <em>26°</em>
                                                </li>
                                                <li>
                                                    <span>{{ trans('homepage.sat') }}</span>
                                                    <a href="#" title=""><i class="wi wi-day-sunny-overcast"></i></a>
                                                    <em>30°</em>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget stick-widget">
                                    <h4 class="widget-title">{{ trans('homepage.who_follow') }}</h4>
                                    <ul class="followers">
                                        <li>
                                            <figure><img src="{{ asset('bower_components/blog_template/images/resources/friend-avatar2.jpg') }}" alt=""></figure>
                                            <div class="friend-meta">
                                                <h4><a href="#" title="">{{ trans('homepage.user_name') }}</a></h4>
                                                <a href="#" title="" class="underline">{{ trans('homepage.follow') }}</a>
                                            </div>
                                        </li>
                                        <li>
                                            <figure><img src="{{ asset('bower_components/blog_template/images/resources/friend-avatar4.jpg') }}" alt=""></figure>
                                            <div class="friend-meta">
                                                <h4><a href="#" title="">{{ trans('homepage.user_name') }}</a></h4>
                                                <a href="#" title="" class="underline">{{ trans('homepage.follow') }}</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </aside>
                        </div>
                        <div class="col-lg-8">
                            <div class="central-meta postbox">
                                <span class="create-post">{{ trans('homepage.create_post') }}</span>
                                <form action="{{ route('stories.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="new-postbox">
                                        <div class="more">
                                            <div class="more-post-optns"><i class="ti-more-alt"></i>
                                                <ul>
                                                    <select name="status" id="category">
                                                        <option value="public"><i class="fa fa-pencil-square-o"></i>{{ trans('homepage.public') }}</option>
                                                        <option value="draft"><i class="far fa-sticky-note"></i>{{ trans('homepage.draft') }}</option>
                                                    </select>
                                                </ul>
                                            </div>
                                        </div>
                                        <figure><img src="{{ asset('bower_components/blog_template/images/resources/admin.jpg') }}" alt=""></figure>
                                        <div class="newpst-input">
                                            <label>{{ trans('homepage.title') }}</label>
                                            <input class="px-5" type="text" name="title">
                                            @if ($errors->has('title'))
                	                            <div class="alert alert-danger">
                                                    {{ $errors->first('title') }}
                	                            </div>
                                            @endif
                                            <textarea rows="2" name="content"></textarea>
                                            @if ($errors->has('content'))
                                                <div class="alert alert-danger">
                                                    {{ $errors->first('content') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="attachments">
                                            <ul>
                                                <li>
                                                    <i class="fa fa-image"></i>
                                                    <label class="fileContainer"><input type="file"  name="photos[]" multiple></label>
                                                </li>
                                                <li>
                                                    <select name="category" id="category">
                                                        <option value=""></option>
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </li>
                                            </ul>
                                            <button class="post-btn" type="submit" data-ripple="">{{ trans('homepage.create_post') }}</button>
                                        </div>
                                    </div>	
                                </form>
                            </div>
                            <div class="loadMore">
                                <div class="central-meta item">
                                    <div class="user-post">
                                        <div class="friend-info">
                                            @foreach($stories as $story)
                                                <figure>
                                                    @foreach($story->user->images as $image)
                                                        <img src="{{ asset($image->image_url) }}" alt="">
                                                    @endforeach
                                                </figure>
                                                <div class="friend-name">
                                                    <div class="more">
                                                        <div class="more-post-optns"><i class="ti-more-alt"></i>
                                                            <ul>
                                                                <li><a href="{{ route('stories.edit', $story->id) }}"><i class="fa fa-pencil-square-o"></i>{{ trans('homepage.edit_post') }}</a></li>
                                                                <li>
                                                                    <form action="{{ route('stories.destroy', $story->id)}}" method="Post">
                                                                        @method('Delete')
                                                                        @csrf
                                                                        <button class="btn-danger">{{ trans('homepage.delete_post') }}</button>
                                                                    </form> 
                                                                </li>
                                                                <li><i class="far fa-bookmark"></i>{{ trans('homepage.bookmark') }}</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <ins><a href="#" title="">{{ $story->user->username }}</a><br>
                                                    <span><i class="fa fa-globe"></i> {{ $story->status }}: {{ $story->created_at }} </span><br>
                                                    <span>{{ trans('homepage.category') }}: {{ $story->category->name }}</span>
                                                </div>
                                                <div class="post-meta">
                                                    @if(count($story->images)>0)
                                                        <figure >
                                                            @if(count($story->images)==1)
                                                                <img src="{{ asset( $story->images[0]->image_url ) }}" >
                                                            @endif
                                                            @if(count($story->images)>1)
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
                                                        <a href="{{ route('stories.show', [$story->id]) }}"><h6>{{ $story->title }}</h6></a><br>
                                                        <p>
                                                            {{ $story->content }}
                                                        </p>
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
                                                <div class="coment-area" >
                                                    <ul class="we-comet">
                                                        @foreach($story->comments as $comment)
                                                            <li>
                                                                <div class="comet-avatar">
                                                                    @foreach($comment->user->images as $image)
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
                                                            <div class="comet-avatar">
                                                                <img src="{{ asset('bower_components/blog_template/images/resources/nearly1.jpg') }}" alt="">
                                                            </div>
                                                            <div class="post-comt-box">
                                                                <form method="post">
                                                                    <textarea></textarea>
                                                                    <button type="submit"></button>
                                                                </form>	
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    {{$stories->links("pagination::bootstrap-4")}}
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
