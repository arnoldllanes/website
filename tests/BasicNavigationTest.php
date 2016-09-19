<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BasicNavigationTest extends TestCase
{
    public function testBasicNavigation()
    {
        $this->visit('/');
        $this->see('Latest Blog Post');
        $this->visit('/presentations');
        $this->see('presentations');
        $this->visit('/presenters');
        $this->visit('/about');
        $this->see('Eric Van Johnson');
        $this->visit('/resources');
        $this->see('Podcast');
        $this->visit('/posts');
        $this->see('Blog Posts');
    }
}
