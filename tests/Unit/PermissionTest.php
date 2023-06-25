<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\UserRole;
use App\Services\CheckPermissionService;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_checkPermissions()
    {
        $user = $this->createFakeData();

        $this->assertTrue(CheckPermissionService::getHighestRoleFromUser($user) === CheckPermissionService::$SUPER_ADMINISTRATOR);
        $this->assertTrue(CheckPermissionService::hasHigherRole($user, CheckPermissionService::$ADMINISTRATOR));
        $this->assertTrue(CheckPermissionService::hasRole($user, CheckPermissionService::$SALES));
        $this->assertTrue(CheckPermissionService::hasRoleOrHigher($user, CheckPermissionService::$ADMINISTRATOR));


        $this->assertFalse(CheckPermissionService::hasRole($user, CheckPermissionService::$TRUCK_DRIVER));

    }

    private function createFakeData()
    {
        $user = User::create([
            "name" => "test",
            "email" => "test@test.test",
            "password" => Hash::make("test"),
            "role" => "admin",
            "language" => "nl"
        ]);

        UserRole::create([
            "user_id" => $user["id"],
            "super_admin" => true,
            "admin" => true,
            "truck_driver" => false,
            "sales" => true,
        ]);

        return $user;
    }
}
