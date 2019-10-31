<?php

namespace ppFinal\ApplyingFinalKeyword\PreferInterfaceImplementation;

use ppFinal\Comment;

/**
 * Simple block of comments
 */
final class SimpleCommentBlock implements CommentBlock
{
    /**
     * @var Comment[] Array of comments
     */
    protected $comments = [];

    /**
     * Returns a string view of the comment to output to the template
     *
     * @param int $key
     * @return string
     */
    public function viewComment(int $key) : string
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
        foreach($this->comments as $key => $comment) {
            $view .= $this->viewComment($key);
        }
        return $view;
    }
}

