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
     * @param int $key
     * @return Comment|null
     */
    public function getComment(int $key): ?Comment
    {
        /* Perhaps some additional processing */
        return $this->comment[$key] ?? null;
    }
}