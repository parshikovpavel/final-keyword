<?php

namespace PPFinal\InheritanceIssues\OpenRecursionByDefault;

use PPFinal\Comment;

/**
 * Custom block of comments
 */
class CustomCommentBlock extends CommentBlock
{
    /**
     * Set array of comments
     *
     * Violation of the principle of the information hiding
     * The method allows you to change `CommentBlock::$comments` property
     * hidden in the parent class
     *
     * @param array $comments
     */
    public function setComments(array $comments): void
    {
        $this->comments = $comments;
    }

    /**
     * Get a comment by a key returned by `Comment::getKey()` method
     *
     * Changing the behavior of the method of the parent class
     *
     * @param int $key
     * @return Comment|null
     */
    public function getComment(int $key) : ?Comment
    {
        foreach ($this->comments as $comment) {
            if ($comment->getKey() === $key) {
                /* Perhaps some additional processing */
                return $comment;
            }
        }

        return null;
    }
}