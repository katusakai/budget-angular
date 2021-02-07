<?php

namespace Tests\Feature;

use App\Models\User;

/**
 * Trait AdminUser
 * Adds property admin user for test
 * @package Tests\Feature
 */
trait AdminUser
{
    protected $adminUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->adminUser = User::whereEmail(env('ADMIN_EMAIL'))->first();
    }

}
