<?php

namespace ppFinal\ApplyingFinalKeyword\UsingFinalClassesInTests;

use PHPUnit\Framework\TestCase;
use \Mockery;
use \DG\BypassFinals;


final class SimpleCommentBlockTest extends TestCase
{
    public function testCreatingTestDouble(): void
    {
        $mock = $this->createMock(SimpleCommentBlock::class);
    }

    public function testCreatingProxyDouble(): void
    {
        /* The instance of the original class */
        $simpleCommentBlock = new SimpleCommentBlock();

        /* The test proxy double */
        $proxy = Mockery::mock($simpleCommentBlock);

        /* Stubbing method behavior */
        $proxy->shouldReceive('viewComment')
              ->andReturn('text');

        /* Checking stubbing method behavior */
        $this->assertEquals('text', $proxy->viewComment(1));

        /* `$proxy` isn't an instance of the `SimpleCommentBlock` class */
        $this->assertNotInstanceOf(SimpleCommentBlock::class, $proxy);
    }

    public function testUsingBypassFinals(): void
    {
        BypassFinals::enable();

        $mock = $this->createMock(SimpleCommentBlock::class);
    }


}