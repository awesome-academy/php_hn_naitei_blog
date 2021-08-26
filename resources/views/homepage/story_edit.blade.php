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
                                        <div>
                                            <h3>{{ trans('homepage.edit_story') }}</h3>
                                        </div>
                                        <div class="col-12">
                                            <form action="{{ route('story.update', $story->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <label><b>{{ trans('homepage.title') }}</b></label>
                                                    <input type="text" class="form-control " value="{{ $story->title }}" name="title" placeholder="{{ trans('placehold.title') }}" />
                                                </div>
                                                <div class="form-group">
                                                    <label><b>{{ trans('homepage.content_story') }}</b></label>
                                                    <textarea   name="content" value="{{ $story->content }}" placeholder="{{ trans('placehold.content') }}"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label><b>{{ trans('homepage.avatar') }}</b></label>
                                                    <input type="file"  name="photos[]" multiple>
                                                </div>
                                                <div class="form-group filled">
                                                    <label><b>{{ trans('homepage.category') }}</b></label>
                                                    <select class="form-control1 ng-invalid ng-invalid-required" name="category" value="{{ $story->categories_id }}" ng-model="model.select" required="">
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->id}}">{{ $category->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group filled">
                                                    <label><b>{{ trans('homepage.status') }}</b></label>
                                                    <select class="form-control1 ng-invalid ng-invalid-required" name="status" ng-model="model.select" required="">
                                                        <option value="public">{{ trans('homepage.public') }}</option>
                                                        <option value="draft">{{ trans('homepage.draft') }}</option>
                                                        <option value="unlisted">{{ trans('homepage.unlisted') }}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group d-flex align-items-center flex-column">
                                                    <button type="submit" class="btn btn-primary">{{ trans('homepage.submit') }}</button>
                                                </div>
                                            </form>
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
