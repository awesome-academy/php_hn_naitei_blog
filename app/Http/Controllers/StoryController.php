<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoryRequest;
use App\Repositories\Contracts\StoryRepositoryInterface;

class StoryController extends Controller
{
    protected $storyRepository;

    public function __construct(StoryRepositoryInterface $storyRepository)
    {
        $this->middleware('auth');
        $this->storyRepository = $storyRepository;
    }

    public function store(StoryRequest $request)
    {
        if (Gate::allows('is-active')) {
            $storyDataArray = [
                "categories_id" => $request->category,
                "content" => $request->content,
                "status" => $request->status,
                "users_id" => Auth::id(),
            ];
           
            $story = $this->storyRepository->create($storyDataArray);
            if ($request->photos != null) {
                foreach (array($request->photos) as $photo) {
                    $newImageName = 'storage/image/' .uniqid() . '.' . $photo->extension();
                    $photo->move(public_path('storage/image'), $newImageName);
                    $story->images()->create([
                       'image_url' => $newImageName,
                    ]);
                }
            }
    
            return redirect()->route('home')->with('message', trans('message.create_success'));
        } else {
            return response('Unauthorizaed action.', 403);
        }
    }

    public function show($id)
    {
        $story= $this->storyRepository->findOrFail($id);
        $user = $story->user;

        return view('homepage.story_detail', compact('story', 'user'));
    }

    public function edit($id)
    {
        $story = $this->storyRepository->findOrFail($id);
        $this->authorize('update', $story);
        $categories = Category::all();

        return view('homepage.story_edit', compact('story', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $story = $this->storyRepository->findOrFail($id);
        $this->authorize('update', $story);

        $story->update([
            'content' =>  $request->content,
            'status' => $request->status,
        ]);
        if ($request->photos != null) {
            $story->images()->delete();
            if (count(array($request->photos)) > 0) {
                foreach (array($request->photos) as $photo) {
                    $newImageName = 'storage/image/' .uniqid() . '.' . $photo->extension();
                    $photo->move(public_path('storage/image'), $newImageName);
                    $story->images()->create([
                        'image_url' => $newImageName,
                    ]);
                }
            }
        }

        return redirect()->route('stories.show', $id)->with('message', trans('message.update_success'));
    }

    public function destroy($id)
    {
        $story = $this->storyRepository->findOrFail($id);
        $this->authorize('delete', $story);

        $story->images()->delete();
        $this->storyRepository->forceDelete($id);

        return response()->json([
            'success' =>  trans('message.delete_success')
        ]);
    }

    public function hideStory($id)
    {
        if (Gate::allows('is-admin') || Gate::allows('is-inspector')) {
            $story = $this->storyRepository->delete($id);
            if ($story != null) {
                return response()->json([
                    'message' => 'success',
                ]);
            } else {
                return response()->json([
                    'message' => 'fail',
                ]);
            }
        } else {
            return response('Unauthorizaed action.', 403);
        }
    }
}
