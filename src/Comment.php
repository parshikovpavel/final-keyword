<?php

namespace PPFinal;

/**
 * Class of comment
 */
class Comment
{
    /**
     * @var int Key of comment
     */
    private $key;

    /**
     * Get key of comment
     *
     * @return int
     */
    public function getKey(): int
    {
        return $this->key;
    }

}