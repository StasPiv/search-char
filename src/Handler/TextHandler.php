<?php
/**
 * Created by search-char.
 * User: ssp
 * Date: 16.08.16
 * Time: 11:48
 */

namespace StasPiv\SearchChar\Handler;


use StasPiv\SearchChar\Model\Keyword;
use StasPiv\SearchChar\Model\Occurrence;
use StasPiv\SearchChar\Model\State;
use StasPiv\SearchChar\Model\Text;
use StasPiv\SearchChar\Model\TextIteratorInterface;

class TextHandler
{
    /**
     * @param TextIteratorInterface $text
     * @return string
     */
    public function getCurrentChar(TextIteratorInterface $text): string
    {
        if (!isset($text->getText(){$text->getCurrentCharIndex()})) {
            return '';
        }

        return $text->getText(){$text->getCurrentCharIndex()};
    }

    /**
     * @param Text $text
     * @param Keyword $keyword
     * @return array
     */
    public function searchOccurrences(Text $text, Keyword $keyword): array
    {
        $occurrences = [];

        do {
            $occurrence = new Occurrence();
            $occurrence->setFirstCharIndex($text->getCurrentCharIndex())->setKeyword($keyword);

            $this->process($text, $keyword);
            $keyword->setCurrentCharIndex(0);

            if ($keyword->getCurrentState() == State::OK) {
                $occurrences[] = $occurrence->setLastCharIndex($text->getCurrentCharIndex() - 1);
            }

            $text->increaseCharIndex();

        } while (!empty($this->getCurrentChar($text)));

        return $occurrences;
    }

    /**
     * @param Text $text
     * @param Keyword $keyword
     * @return bool
     */
    private function compareCurrentChars(Text $text, Keyword $keyword): bool
    {
        return !empty($this->getCurrentChar($text)) && $this->getCurrentChar($text) === $this->getCurrentChar($keyword);
    }

    /**
     * @param Text $text
     * @param Keyword $keyword
     */
    private function process(Text $text, Keyword $keyword)
    {
        $keyword->setCurrentState(State::MAYBE);

        while ($this->compareCurrentChars($text, $keyword)) {
            $text->increaseCharIndex();
            $keyword->increaseCharIndex();
        }

        if ($this->isSpaceSymbolCurrent($text) && $this->isEnd($keyword)) {
            $keyword->setCurrentState(State::OK);
        } else {
            $keyword->setCurrentState(State::FAIL);
        }
    }

    /**
     * @param TextIteratorInterface $text
     * @return int
     */
    private function isSpaceSymbolCurrent(TextIteratorInterface $text)
    {
        return $this->isEnd($text) || preg_match('/\W/', $this->getCurrentChar($text));
    }

    /**
     * @param TextIteratorInterface $text
     * @return bool
     */
    private function isEnd(TextIteratorInterface $text)
    {
        return $text->getLastCharIndex() == $text->getCurrentCharIndex() - 1;
    }
}