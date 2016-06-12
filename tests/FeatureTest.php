<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class FeatureTest extends TestCase
{
    use DatabaseTransactions;

    public function test_filter_features()
    {
        $this->visit('/')
             ->see('Laravel 5');
    }
}
