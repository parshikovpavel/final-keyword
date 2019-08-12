<?php

namespace PPFinal\InheritanceIssues\ControlOfSideEffects;

use PPFinal\Comment;

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
     * Set array of comments
     *
     * @param array $comments
     */
    public function setComments(array $comments): void
    {
        $this->comments = $comments;
    }

    /**
     * Return a string view of the comment to output to the template
     *
     * @param int $key
     * @return string
     */
    public function viewComment(int $key) : string
    {
        return $this->comments[$key]->view();
    }
}