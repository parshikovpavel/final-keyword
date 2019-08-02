<?php

namespace PPFinal\InheritanceIssues\InformationHiding;

use PPFinal\Comment;

/**
 * Block of comments
 */
class CommentBlock
{
    /**
     * Array of comments
     * @var Comment[]
     */
    protected $comments = [];

    /**
     * Get a comment by key in `$comments` array
     * @param int $key
     * @return Comment|null
     */
    public function getComment(int $key): ?Comment
    {
        /* Perhaps some additional processing */
        return $this->comment[$key] ?? null;
    }
}