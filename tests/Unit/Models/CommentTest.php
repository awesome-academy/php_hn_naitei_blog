<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Comment;
use App\Models\User;
use App\Models\Story;

class CommentTest extends TestCase
{
    protected $comment;

    public function setUp():void
    {
        parent::setUp();
        $this->comment = new Comment();
    }

    public function tearDown(): void
    {
        $this->comment = null;
        parent::tearDown();
    }

    public function testModelConfiguration()
    {
        $fillable = ['content', 'status', 'parent', 'stories_id', 'users_id'];

        $this->assertEquals($fillable, $this->comment->getFillable());
    }

    public function testCommentBelongsToStory()
    {
        $relation = $this->comment->story();

        $this->assertInstanceOf(BelongsTo::class, $relation, 'Relation is wrong');
        $this->assertInstanceOf(Story::class, $relation->getRelated(), 'Related model is wrong');
        $this->assertEquals('id', $relation->getOwnerKeyName(), 'Owner key is wrong');
        $this->assertEquals('stories_id', $relation->getForeignKeyName(), 'Foreign key is wrong');
    }

    public function testCommentBelongsToUser()
    {
        $relation = $this->comment->user();

        $this->assertInstanceOf(BelongsTo::class, $relation, 'Relation is wrong');
        $this->assertInstanceOf(User::class, $relation->getRelated(), 'Related model is wrong');
        $this->assertEquals('id', $relation->getOwnerKeyName(), 'Owner key is wrong');
        $this->assertEquals('users_id', $relation->getForeignKeyName(), 'Foreign key is wrong');
    }
}
