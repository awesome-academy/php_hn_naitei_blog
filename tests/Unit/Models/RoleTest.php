<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Role;
use App\Models\User;

class RoleTest extends TestCase
{
    protected $role;

    public function setUp():void
    {
        parent::setUp();
        $this->role = new Role();
    }

    public function tearDown(): void
    {
        $this->role = null;
        parent::tearDown();
    }

    public function testModelConfiguration()
    {
        $fillable = ['name'];

        $this->assertEquals($fillable, $this->role->getFillable());
    }

    public function testRoleHasManyUsers()
    {
        $relation = $this->role->users();

        $this->assertInstanceOf(HasMany::class, $relation, 'Relation is wrong');
        $this->assertInstanceOf(User::class, $relation->getRelated(), 'Related model is wrong');
        $this->assertEquals('role_id', $relation->getForeignKeyName(), 'Foreign key is wrong');
    }
}
