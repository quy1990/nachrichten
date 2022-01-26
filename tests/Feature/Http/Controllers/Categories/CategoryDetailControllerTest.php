<?php

namespace Http\Controllers\Categories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryDetailControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test__invoke()
    {
        $category = Category::factory()->create();
        User::factory()
            ->hasPosts(30, [
                'title'       => "abc 1",
                'category_id' => $category->id,
            ])
            ->create();
        $response = $this->json('GET', '/api/categoriesDetail');

        $response->assertStatus(200);
    }
}
