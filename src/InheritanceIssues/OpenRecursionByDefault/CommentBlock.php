<?php

namespace ppFinal\InheritanceIssues\OpenRecursionByDefault;

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
     * @param Comment[] $comments
     */
    public function __construct(array $comments)
    {
        $this->comments = $comments;
    }

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

    /**
     * Get an array of comments by collecting them using `getComment()`
     *
     * This method doesn't works correctly in child class `CustomCommentBlock`,
     * because `CommentBlock::getComment()` and `CustomCommentBlock::getComment()` behavior
     * are different
     *
     * @return array
     */
    public function getComments(): array
    {
        $comments = [];
        foreach ($this->comments as $key => $comment) {
            $comments[] = $this->getComment($key);
        }
        return $comments;
    }
}