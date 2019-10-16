<?php

namespace ppFinal\InheritanceIssues\ControlOfSideEffects;

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
     * CommentBlock constructor
     *
     * @param Comment[] $comments
     */
    public function __construct(array $comments)
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