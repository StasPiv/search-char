<?php
/**
 * Created by search-char.
 * User: ssp
 * Date: 16.08.16
 * Time: 11:39
 */

namespace StasPiv\SearchChar\Model;


class Keyword implements TextIteratorInterface
{
    use TextIteratorTrait;

    /**
     * @var integer
     */
    private $currentState = State::MAYBE;

    /**
     * @return int
     */
    public function getCurrentState(): int
    {
        return $this->currentState;
    }

    /**
     * @param int $currentState
     * @return Keyword
     */
    public function setCurrentState(int $currentState): self
    {
        $this->currentState = $currentState;
        return $this;
    }
}