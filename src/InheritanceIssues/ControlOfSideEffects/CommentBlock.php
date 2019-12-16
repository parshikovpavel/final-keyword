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
     * Returns a string view of the comment to output to the template
     *
     * @param string $key
     * @return string
     */
    public function viewComment(string $key): string
    {
        return $this->comments[$key]->view();
    }

    /**
     * Returns a string view of all comments in the block as a single string
     *
     * @return string
     */
    public function viewComments(): string
    {
        $view = '';
        foreach ($this->comments as $key => $comment) {
            $view .= $comment->view();
        }
        return $view;
    }
}
