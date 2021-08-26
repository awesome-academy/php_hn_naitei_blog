@extends('homepage.app')

@section('content')
<section>
    <div class="gap2 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row merged20" id="page-contents">
                        <div class="col-lg-4 col-md-4">
                            <aside class="sidebar">
                            <div class="central-meta stick-widget">
                                <span class="create-post">Personal Info</span>
                                <div class="personal-head">
                                    <span class="f-title"><i class="fa fa-user"></i> About Me:</span>
                                    <span class="f-title"><i class="fa fa-medkit"></i> Email</span>
                                    <p>
                                        Email
                                    </p>
                                    <span class="f-title"><i class="fa fa-male"></i> User Name</span>
                                    <p>
                                        User Name
                                    </p>
                                    <span class="f-title">
                                        <a href="#" class="nav-link" data-toggle="tab" ><i class="fa fa-pencil"></i> Edit Profile</a>
                                                
                                </div>
                            </div>
                            </aside>	
                        </div>	
                        <div class="col-lg-8 col-md-8">
                            <div class="loadMore">
                                <div class="central-meta item">
                                    <div class="user-post">
                                        <div class="friend-info">
                                            <figure>
                                                <img src="{{ asset('bower_components/blog_template/images/resources/nearly1.jpg') }}" alt="">
                                            </figure>
                                            <div class="friend-name">
                                                <div class="more">
                                                    <div class="more-post-optns"><i class="ti-more-alt"></i>
                                                        <ul>
                                                            <li><i class="fa fa-pencil-square-o"></i>Edit Post</li>
                                                            <li><i class="fa fa-trash-o"></i>Delete Post</li>
                                                            <li><i class="far fa-bookmark"></i>Bookmark</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <ins><a href="time-line.html" title="">User Name</a>
                                                <span><i class="fa fa-globe"></i> Status: january,5 2010 19:PM </span>
                                            </div>
                                            <div class="post-meta">
                                                <figure style=" height: 400px;">
                                                    <div id="demo"  class="carousel slide row"  data-ride="carousel"> 
                                                        <div class="carousel-inner col-12" >
                                                              <div class="carousel-item">
                                                                <img src="{{ asset('bower_components/blog_template/images/resources/userlist-1.jpg') }}" style="width: 1000px; height: 400px;" >
                                                              </div>
                                                              <div class="carousel-item active carousel-item-left">
                                                                <img src="{{ asset('bower_components/blog_template/images/resources/userlist-1.jpg') }}" style="width: 1000px; height: 400px;" >
                                                              </div>

                                                        </div>
                                                        <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                                              <span class="carousel-control-prev-icon"></span>
                                                        </a>
                                                        <a class="carousel-control-next" href="#demo" data-slide="next">
                                                              <span class="carousel-control-next-icon"></span>
                                                        </a>
                                                       </div>
                                                </figure>												
                                                <div class="description">
                                                    <h5>Title</h5>
                                                    <p>
                                                        Content .
                                                    </p>
                                                </div>
                                                <div class="we-video-info">
                                                    <ul>
                                                        
                                                        <li>
                                                            <div class="likes heart" title="Like/Dislike">❤ <span>2K</span></div>
                                                        </li>
                                                        <li>
                                                            <span class="comment" title="Comments">
                                                                <i class="fa fa-commenting"></i>
                                                                <ins>52</ins>
                                                            </span>
                                                        </li>

                                                    </ul>
                                                    
                                                </div>
                                            </div>
                                            <div class="coment-area" style="">
                                                <ul class="we-comet">
                                                    <li>
                                                        <div class="comet-avatar">
                                                            <img src="{{ asset('bower_components/blog_template/images/resources/nearly3.jpg') }}" alt="">
                                                        </div>
                                                        <div class="we-comment">
                                                            <h5><a href="time-line.html" title="">Jason borne</a></h5>
                                                            <p>we are working for the dance and sing songs. this video is very awesome for the youngster. please vote this video and like our channel</p>
                                                            <div class="inline-itms">
                                                                <span>1 year ago</span>
                                                                <a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>
                                                                <a href="#" title=""><i class="fa fa-heart"></i><span>20</span></a>
                                                            </div>
                                                        </div>

                                                    </li>
                                                    <li>
                                                        <div class="comet-avatar">
                                                            <img src="{{ asset('bower_components/blog_template/images/resources/comet-4.jpg ') }}" alt="">
                                                        </div>
                                                        <div class="we-comment">
                                                            <h5><a href="time-line.html" title="">Sophia</a></h5>
                                                            <p>we are working for the dance and sing songs. this video is very awesome for the youngster.
                                                                
                                                            </p>
                                                            <div class="inline-itms">
                                                                <span>1 year ago</span>
                                                                <a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>
                                                                <a href="#" title=""><i class="fa fa-heart"></i><span>20</span></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <a href="#" title="" class="showmore underline">more comments+</a>
                                                    </li>
                                                    <li class="post-comment">
                                                        <div class="comet-avatar">
                                                            <img src="{{ asset('bower_components/blog_template/images/resources/nearly1.jpg') }}" alt="">
                                                        </div>
                                                        <div class="post-comt-box">
                                                            <form method="post">
                                                                <textarea placeholder="Post your comment"></textarea>
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
    </div>	
</section>
@endsection

