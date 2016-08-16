<?php
/**
 * Created by search-char.
 * User: ssp
 * Date: 16.08.16
 * Time: 11:42
 */

namespace StasPiv\SearchChar\Model;


class Occurrence
{
    /**
     * @var integer
     */
    private $firstCharIndex;

    /**
     * @var integer
     */
    private $lastCharIndex;

    /**
     * @var Keyword
     */
    private $keyword;

    /**
     * @return int
     */
    public function getFirstCharIndex(): int
    {
        return $this->firstCharIndex;
    }

    /**
     * @param int $firstCharIndex
     * @return Occurrence
     */
    public function setFirstCharIndex(int $firstCharIndex): self
    {
        $this->firstCharIndex = $firstCharIndex;
        return $this;
    }

    /**
     * @return int
     */
    public function getLastCharIndex(): int
    {
        return $this->lastCharIndex;
    }

    /**
     * @param int $lastCharIndex
     * @return Occurrence
     */
    public function setLastCharIndex(int $lastCharIndex): self
    {
        $this->lastCharIndex = $lastCharIndex;
        return $this;
    }

    /**
     * @return Keyword
     */
    public function getKeyword(): Keyword
    {
        return $this->keyword;
    }

    /**
     * @param Keyword $keyword
     * @return Occurrence
     */
    public function setKeyword(Keyword $keyword): self
    {
        $this->keyword = $keyword;
        return $this;
    }
}