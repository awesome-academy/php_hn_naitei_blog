<?php

namespace Tests\Unit\Http\Controllers;

use Tests\TestCase;
use Mockery as m;
use App\Http\Controllers\StoryController;
use App\Repositories\Contracts\StoryRepositoryInterface;
use App\Http\Requests\StoryRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Models\Story;
use App\Models\User;

class StoryControllerTest extends TestCase
{
    protected $storyController, $storyRepositoryMock;

    public function setUp(): void
    {
        $this->afterApplicationCreated(function() {
            $this->storyRepositoryMock = m::mock(StoryRepositoryInterface::class)->makePartial();

            $this->storyController = new StoryController(
                $this->app->instance(StoryRepositoryInterface::class, $this->storyRepositoryMock)
            );
        });
        parent::setUp();
    }

    public function tearDown(): void
    {
        m::close();
        parent::tearDown();
    }

    public function testItStoresNewStory()
    {
        $this->assertInstanceOf(StoryController::class, $this->storyController);

        $request = new StoryRequest();
        $request['category'] = 1;
        $request['content'] = 'content';
        $request['status'] = 'public';

        $user = m::mock(User::class)->makePartial();
        $user->shouldReceive('getAttribute')->with('id')->andReturn(2);
        $user->shouldReceive('getAttribute')->with('username')->andReturn('trang');
        $user->shouldReceive('getAttribute')->with('email')->andReturn('trang@gmail.com');
        $user->shouldReceive('getAttribute')->with('status')->andReturn(1);
        $this->actingAs($user);

        $data = [
            "categories_id" => 1,
            "content" => 'content',
            "status" => 'public',
            "users_id" => Auth::id(),
        ];

        if ($user->status == 1) {
            $this->storyRepositoryMock->shouldReceive('create')->with($data)->once()->andReturn();
            
            // Storage::extend('mock', function() {
            //     return \Mockery::mock(\Illuminate\Contracts\Filesystem\Filesystem::class);
            // });
    
            // Config::set('filesystems.disks.mock', ['driver' => 'mock']);
            // Config::set('filesystems.default', 'mock');
            // $storage = Storage::disk();
            // $storage->shouldReceive('put')->with('image.jpg', )->once();

            $result = $this->storyController->store($request);
            $this->assertInstanceOf(RedirectResponse::class, $result);
            $this->assertEquals(route('home'), $result->getTargetUrl());
        } else {

        }
        
    }

    public function testItShowStory()
    {
        $id = rand();
        $this->storyRepositoryMock->shouldReceive('findOrFail')->with($id)->andReturn(new Story());
        $result = $this->storyController->show($id);
        $data = $result->getData();
        $this->assertIsArray($data);
        $this->assertArrayHasKey('story', $data);
        $this->assertArrayHasKey('user', $data);
        $this->assertEquals('homepage.story_detail', $result->getName());
    }

    public function testItEditStory()
    {
        $user = m::mock(User::class)->makePartial();
        $user->shouldReceive('getAttribute')->with('id')->andReturn(2);
        $user->shouldReceive('getAttribute')->with('username')->andReturn('trang');
        $user->shouldReceive('getAttribute')->with('email')->andReturn('trang@gmail.com');
        $user->shouldReceive('getAttribute')->with('status')->andReturn(1);
        $this->actingAs($user);

        $story = m::mock(Story::class)->makePartial();
        $story->shouldReceive('getAttribute')->with('users_id')->andReturn(Auth::id());
        $story->shouldReceive('getAttribute')->with('id')->andReturn(1);
        $this->storyRepositoryMock->shouldReceive('findOrFail')->with($story->id)->andReturn($story);

        $result = $this->storyController->edit($story->id);
        $data = $result->getData();
        $this->assertIsArray($data);
        $this->assertArrayHasKey('story', $data);
        $this->assertArrayHasKey('categories', $data);
        $this->assertEquals('homepage.story_edit', $result->getName());
    }

    public function testItUpdateStory()
    {
        $user = m::mock(User::class)->makePartial();
        $user->shouldReceive('getAttribute')->with('id')->andReturn(2);
        $user->shouldReceive('getAttribute')->with('username')->andReturn('trang');
        $user->shouldReceive('getAttribute')->with('email')->andReturn('trang@gmail.com');
        $user->shouldReceive('getAttribute')->with('status')->andReturn(1);
        $this->actingAs($user);

        $story = m::mock(Story::class)->makePartial();
        $story->shouldReceive('getAttribute')->with('users_id')->andReturn(Auth::id());
        $story->shouldReceive('getAttribute')->with('id')->andReturn(1);
        $this->storyRepositoryMock->shouldReceive('findOrFail')->with($story->id)->andReturn($story);
    
        
    }
    
}
