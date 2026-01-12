<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{
    public function test_home_page_loads_and_has_expected_view_data()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('home');

        $response->assertViewHas('featuredCourses');
        $response->assertViewHas('latestPosts');
        $response->assertViewHas('counts');
        $response->assertViewHas('q');

        $response->assertSee('Build skills. Teach others. Grow together.');
    }
}
