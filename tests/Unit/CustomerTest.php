<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_customers_database_has_extected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('customers', [
                'id', 'code', 'name', 'birthday', 'avatar'
            ]), 
        1);
    }
}
