<?php
/**
 * Created by search-char.
 * User: ssp
 * Date: 16.08.16
 * Time: 12:06
 */

namespace StasPiv\SearchChar\Model;


interface TextIteratorInterface
{

    /**
     * @return int
     */
    public function getCurrentCharIndex() : int;

    /**
     * @param int $currentCharIndex
     * @return TextIteratorInterface
     */
    public function setCurrentCharIndex(int $currentCharIndex) : TextIteratorInterface;

    /**
     * @return TextIteratorInterface
     */
    public function increaseCharIndex() : TextIteratorInterface;

    /**
     * @return string
     */
    public function getText() : string;

    /**
     * @param string $text
     * @return TextIteratorInterface
     */
    public function setText(string $text) : TextIteratorInterface;
}