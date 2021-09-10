<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Models\User;
use App\Models\Story;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Bookmark;
use App\Models\Follow;
use App\Models\Role;
use App\Models\Image;

class UserTest extends TestCase
{
    protected $user;

    public function setUp():void
    {
        parent::setUp();
        $this->user = new User();
    }

    public function tearDown(): void
    {
        $this->user = null;
        parent::tearDown();
    }

    public function testModelConfiguration()
    {
        $fillable = ['username', 'email', 'password', 'status'];
        $hidden = ['password', 'remember_token'];
        $casts = ['email_verified_at' => 'datetime', 'id' => 'int'];

        $this->assertEquals($fillable, $this->user->getFillable());
        $this->assertEquals($hidden, $this->user->getHidden());
        $this->assertEquals($casts, $this->user->getCasts());
    }

    public function testUserHasManyStories()
    {
        $relation = $this->user->stories();

        $this->assertInstanceOf(HasMany::class, $relation, 'Relation is wrong');
        $this->assertInstanceOf(Story::class, $relation->getRelated(), 'Related model is wrong');
        $this->assertEquals('users_id', $relation->getForeignKeyName(), 'Foreign key is wrong');
    }

    public function testUserMorphManyImages()
    {
        $relation = $this->user->images();
        $name = 'imageable';

        $this->assertInstanceOf(MorphMany::class, $relation);
        $this->assertEquals($name.'_type', $relation->getMorphType());
        $this->assertEquals($name.'_id', $relation->getForeignKeyName());
    }

    public function testUserHasManyLikes()
    {
        $relation = $this->user->likes();

        $this->assertInstanceOf(HasMany::class, $relation, 'Relation is wrong');
        $this->assertInstanceOf(Like::class, $relation->getRelated(), 'Related model is wrong');
        $this->assertEquals('user_id', $relation->getForeignKeyName(), 'Foreign key is wrong');
    }

    public function testUserHasManyComments()
    {
        $relation = $this->user->comments();

        $this->assertInstanceOf(HasMany::class, $relation, 'Relation is wrong');
        $this->assertInstanceOf(Comment::class, $relation->getRelated(), 'Related model is wrong');
        $this->assertEquals('users_id', $relation->getForeignKeyName(), 'Foreign key is wrong');
    }

    public function testUserHasManyBookmarks()
    {
        $relation = $this->user->bookmarks();

        $this->assertInstanceOf(HasMany::class, $relation, 'Relation is wrong');
        $this->assertInstanceOf(Bookmark::class, $relation->getRelated(), 'Related model is wrong');
        $this->assertEquals('users_id', $relation->getForeignKeyName(), 'Foreign key is wrong');
    }

    public function testUserHasManyFollows()
    {
        $relation = $this->user->follows();

        $this->assertInstanceOf(HasMany::class, $relation, 'Relation is wrong');
        $this->assertInstanceOf(Follow::class, $relation->getRelated(), 'Related model is wrong');
        $this->assertEquals('user_id', $relation->getForeignKeyName(), 'Foreign key is wrong');
    }

    public function testUserBelongsToRole()
    {
        $relation = $this->user->role();

        $this->assertInstanceOf(BelongsTo::class, $relation, 'Relation is wrong');
        $this->assertInstanceOf(Role::class, $relation->getRelated(), 'Related model is wrong');
        $this->assertEquals('id', $relation->getOwnerKeyName(), 'Owner key is wrong');
        $this->assertEquals('roles_id', $relation->getForeignKeyName(), 'Foreign key is wrong');
    }
}
