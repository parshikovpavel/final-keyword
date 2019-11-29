<?php

namespace ppFinal\ApplyingFinalKeyword\TemplateMethodPattern;

use ppFinal\Comment;

/**
 * Abstract block of comments
 */
abstract class CommentBlock
{
    /**
     * @var Comment[] Array of comments
     */
    protected $comments = [];

    /**
     * Returns a string view of the comment to output to the template
     *
     * @param string $key
     * @return string
     */
    abstract public function viewComment(string $key): string;

    /**
     * Returns a string view of all comments in the block as a single string
     *
     * @return string
     */
    final public function viewComments(): string
    {
        $view = '';
        foreach($this->comments as $key => $comment) {
            $view .= $this->viewComment($key);
        }
        return $view;
    }
}
