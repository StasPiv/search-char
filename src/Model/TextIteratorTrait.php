<?php
/**
 * Created by search-char.
 * User: ssp
 * Date: 16.08.16
 * Time: 12:10
 */

namespace StasPiv\SearchChar\Model;


trait TextIteratorTrait
{
    /**
     * @var string
     */
    protected $text;
    /**
     * @var integer
     */
    protected $currentCharIndex = 0;

    /**
     * Text constructor.
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->text = $text;
    }

    /**
     * @return int
     */
    public function getCurrentCharIndex(): int
    {
        return $this->currentCharIndex;
    }

    /**
     * @param int $currentCharIndex
     * @return TextIteratorInterface
     */
    public function setCurrentCharIndex(int $currentCharIndex): TextIteratorInterface
    {
        $this->currentCharIndex = $currentCharIndex;
        return $this;
    }

    /**
     * @return TextIteratorInterface
     */
    public function increaseCharIndex(): TextIteratorInterface
    {
        $this->currentCharIndex++;

        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return TextIteratorInterface
     */
    public function setText(string $text): TextIteratorInterface
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return string
     */
    function __toString()
    {
        return $this->text;
    }

    /**
     * @return int
     */
    public function getLastCharIndex(): int
    {
        return strlen($this->text) - 1;
    }
}