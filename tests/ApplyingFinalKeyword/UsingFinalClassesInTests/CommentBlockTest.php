<?php

namespace ppFinal\ApplyingFinalKeyword\UsingFinalClassesInTests;

use PHPUnit\Framework\TestCase;

final class CommentBlockTest extends TestCase
{
    public function testCreatingTestDouble(): void
    {
        $mock = $this->createMock(CommentBlock::class);
    }
}