<?php

namespace ppFinal\ApplyingFinalKeyword\PreparationForInheritance;

use ppFinal\Comment;

/**
 * Block of comments
 */
class CommentBlock
{
    /**
     * @var Comment[] Array of comments
     */
    private $comments = [];

    /**
     * Returns a string view of the comment to output to the template
     *
     * Overriding of this method allows to add additional functionality
     * (e.g. logging or counting views)
     *
     * @implSpec The implementation gets a comment with `$key` key
     * from the `$this->comments` internal array and calls the `view()` method for it
     *
     * @param string $key Comment key
     * @return string String view of the comment
     */
    public function viewComment(string $key): string
    {
        return $this->comments[$key]->view();
    }

    /**
     * Returns a string view of all comments in the block as a single string
     *
     * @implSpec Iterates over `$this->comments` array
     * and calls `$this->viewComment()` method for each element.
     * Returned string values are concatenated into a single string
     *
     * @return string String view of all comments
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