<?php

namespace ppFinal\ApplyingFinalKeyword\PreparationForAggregation;

use ppFinal\Comment;

/**
 * Simple block of comments
 */
final class SimpleCommentBlock implements CommentBlock
{
    /* ... */

    /**
     * @inheritDoc
     */
    public function getCommentKeys(): array
    {
        /* ... */
    }

    /**
     * @inheritDoc
     */
    public function viewComment(int $key): string
    {
        /* ... */
    }

    /**
     * @inheritDoc
     */
    public function viewComments(): string
    {
        /* ... */
    }
}
