<?php

namespace ppFinal\ApplyingFinalKeyword\UsingFinalClassesInTests;

use PHPUnit\Framework\TestCase;

final class CommentBlockTest extends TestCase
{
    public function testUsingTestDouble(): void
    {
        $mock = $this->createMock(CommentBlock::class);
    }
}