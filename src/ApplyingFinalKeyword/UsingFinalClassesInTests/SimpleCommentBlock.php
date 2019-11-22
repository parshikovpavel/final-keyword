<?php

namespace ppFinal\ApplyingFinalKeyword\UsingFinalClassesInTests;

/**
 * Simple block of comments
 */
final class SimpleCommentBlock implements CommentBlock
{
    /* ... */

    /**
     * Returns a string view of the comment to output to the template
     *
     * @param int $key
     * @return string
     */
    public function viewComment(int $key): string
    {
        /* ... */
    }
}
