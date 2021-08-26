@extends('homepage.app')

@section('content')
<section>
    <div class="gap2 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row merged20" id="page-contents">
                        <div class="col-lg-12">
                            <div class="central-meta">
                                <div class="about">
                                    <div class="d-flex flex-row mt-2">
                                        <ul class="nav nav-tabs nav-tabs--vertical nav-tabs--left" >
                                            
                                            <li class="nav-item">
                                                <a href="#edit-profile" class="nav-link" data-toggle="tab" ><i class="fa fa-pencil"></i> Edit Profile</a>
                                            </li>	
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade" id="edit-profile" >
                                                <div class="set-title">
                                                    <h5>Edit Profile</h5>
                                                </div>
                                                <div class="setting-meta">
                                                    <div class="change-photo">
                                                        <figure><img src="{{ asset('bower_components/blog_template/images/resources/admin2.jpg') }}" alt=""></figure>
                                                        <div class="edit-img">
                                                            <form class="edit-phto">
                                                                <label class="fileContainer">
                                                                    <i class="fa fa-camera-retro"></i>
                                                                    Chage Avatar
                                                                <input type="file">
                                                                </label>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="stg-form-area">
                                                    <form method="post" class="c-form">
                                                        <div>
                                                            <label>User Name</label>
                                                            <input type="text"  name= "email" placeholder="Jack Carter">
                                                        </div>
                                                        
                                                        
                                                        <div>
                                                            <label>Email Address</label>
                                                            <input type="email" name="email" placeholder="abc@pitnikmail.com">
                                                        </div>
                                                        <div>
                                                            <label>Password</label>
                                                            <input type="assword"name="password">
                                                        </div>
                                                        
                                                        <div>
                                                            <button type="submit" data-ripple="">Cancel</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div><!-- edit profile -->
                                        
                                        </div><!-- apps -->
                                        
                                    </div>
                                </div>
                            </div>	
                        </div><!-- centerl meta -->
                        
                    </div>	
                </div>
            </div>
        </div>
    </div>	
</section>
@endsection
