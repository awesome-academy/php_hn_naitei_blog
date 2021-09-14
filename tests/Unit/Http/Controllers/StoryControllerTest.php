<?php

namespace Tests\Unit\Http\Controllers;

use Tests\TestCase;
use Mockery as m;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\StoryController;
use App\Repositories\Contracts\StoryRepositoryInterface;
use App\Http\Requests\StoryRequest;
use App\Models\Story;
use App\Models\User;

class StoryControllerTest extends TestCase
{
    protected $storyController;
    protected $storyRepositoryMock;

    public function setUp(): void
    {
        parent::setUp();
        $this->afterApplicationCreated(function () {
            $this->storyRepositoryMock = m::mock(StoryRepositoryInterface::class)->makePartial();

            $this->storyController = new StoryController(
                $this->app->instance(StoryRepositoryInterface::class, $this->storyRepositoryMock)
            );
        });
    }

    public function tearDown(): void
    {
        m::close();
        $this->storyController = null;
        $this->storyRepositoryMock = null;
        parent::tearDown();
    }

    public function testItStoresNewStory()
    {
        $this->assertInstanceOf(StoryController::class, $this->storyController);
        $user = factory(User::class)->make([
            'id' => 2,
            'status' => 1,
            'roles_id' => 2,
        ]);
        $this->actingAs($user);

        $story = factory(Story::class)->make([
            'id' => 1,
            'users_id' => Auth::id(),
        ]);

        $request = new StoryRequest();
        $request['category'] = $story->categories_id;
        $request['content'] = $story->content;
        $request['status'] = $story->status;
        
        $this->storyRepositoryMock->shouldReceive('create')->with([
            'categories_id' => $request->category,
            'content' => $request->content,
            'status' => $request->status,
            'users_id' => Auth::id(),
        ])->once()->andReturn($story);

        Storage::fake('photos');
        $img = UploadedFile::fake()->image('image.jpg');
        $request['photos'] = $img;

        $result = $this->storyController->store($request);
        $this->assertInstanceOf(RedirectResponse::class, $result);
        $this->assertEquals(route('home'), $result->getTargetUrl());
    }

    public function testUnauthorStoreStory()
    {
        $request = new StoryRequest();
        $result = $this->storyController->store($request);
        $this->assertEquals('Unauthorizaed action.', $result->original);
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
        $user = factory(User::class)->make([
            'id' => 2,
            'status' => 1,
            'roles_id' => 2,
        ]);
        $this->actingAs($user);

        $story = factory(Story::class)->make([
            'id' => 1,
            'users_id' => Auth::id(),
        ]);

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
        $user = factory(User::class)->make([
            'id' => 2,
            'status' => 1,
            'roles_id' => 2,
        ]);
        $this->actingAs($user);

        $story = factory(Story::class)->make([
            'id' => 3,
            'users_id' => Auth::id(),
        ]);

        $this->storyRepositoryMock->shouldReceive('findOrFail')->with($story->id)->andReturn($story);
    
        $request = new Request();
        $request['id'] = 1;
        $request['content'] = $story->content;
        $request['status'] = $story->status;
        $request['users_id'] = Auth::id();

        Storage::fake('photos');
        $img = UploadedFile::fake()->image('photo.jpg');
        $request['photos'] = $img;

        $result = $this->storyController->update($request, $story->id);
        $this->assertInstanceOf(RedirectResponse::class, $result);
        $this->assertEquals(route('stories.show', $story->id), $result->getTargetUrl());
    }

    public function testDestroyStory()
    {
        $user = factory(User::class)->make([
            'id' => 2,
            'status' => 1,
            'roles_id' => 2,
        ]);
        $this->actingAs($user);

        $story = factory(Story::class)->make([
            'id' => 3,
            'users_id' => Auth::id(),
        ]);

        $this->storyRepositoryMock->shouldReceive('findOrFail')->with($story->id)->andReturn($story);
        $this->storyRepositoryMock->shouldReceive('forceDelete')->with($story->id);

        $result = $this->storyController->destroy($story->id);
        $this->assertIsArray($result->original);
        $this->assertArrayHasKey('success', $result->original);
    }

    public function testHideStory()
    {
        $user = factory(User::class)->make([
            'id' => 2,
            'status' => 1,
            'roles_id' => 2,
        ]);
        $this->actingAs($user);
        $story = factory(Story::class)->make([
            'id' => 3,
            'users_id' => Auth::id(),
        ]);

        $this->storyRepositoryMock->shouldReceive('delete')->with($story->id)->andReturn($story);
        $result = $this->storyController->hideStory($story->id);
        $this->assertIsArray($result->original);
        $this->assertArrayHasKey('message', $result->original);
    }

    public function testHideStoryFail()
    {
        $user = factory(User::class)->make([
            'id' => 2,
            'status' => 1,
            'roles_id' => 2,
        ]);
        $this->actingAs($user);
        $id = rand();
        $this->storyRepositoryMock->shouldReceive('delete')->with($id)->andReturn(null);
        $result = $this->storyController->hideStory($id);
        $this->assertIsArray($result->original);
        $this->assertArrayHasKey('message', $result->original);
    }

    public function testUnauthorHideStory()
    {
        $result = $this->storyController->hideStory(1);
        $this->assertEquals('Unauthorizaed action.', $result->original);
    }
}
