<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Title as Title;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }
    public function testTitlesModelCount()
    {
        $title=new title();

            ;

        $this->assertTrue(count($title->all())===5,'count shold be 5');

    }

}
