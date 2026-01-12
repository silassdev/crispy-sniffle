<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{
    public function test_home_page_loads_and_has_expected_view_data()
    {
        $response = $this->get('/');

        // basic status and view checks
        $response->assertStatus(200);
        $response->assertViewIs('home');

        // expected view data from HomeController (even if empty collections)
        $response->assertViewHas('featuredCourses');
        $response->assertViewHas('latestPosts');
        $response->assertViewHas('counts');
        $response->assertViewHas('q');

        // confirm a known piece of content exists in the rendered HTML
        $response->assertSee('Build skills. Teach others. Grow together.');
    }
}
