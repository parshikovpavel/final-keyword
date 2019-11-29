<?php

namespace ppFinal\InheritanceIssues\InformationHiding;

use ppFinal\Comment;

/**
 * Block of comments
 */
class CommentBlock
{
    /**
     * @var Comment[] Array of comments
     */
    protected $comments = [];

    /**
     * Get a comment by key in `$comments` array
     *
     * @param string $key
     * @return Comment|null
     */
    public function getComment(string $key): ?Comment
    {
        /* Perhaps some additional processing */
        return $this->comments[$key] ?? null;
    }
}