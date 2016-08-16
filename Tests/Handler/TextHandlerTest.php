<?php
/**
 * Created by search-char.
 * User: ssp
 * Date: 16.08.16
 * Time: 11:54
 */

namespace StasPiv\SearchChar\Tests\Handler;

use PHPUnit\Framework\TestCase;
use ReflectionMethod;
use StasPiv\SearchChar\Handler\TextHandler;
use StasPiv\SearchChar\Model\Keyword;
use StasPiv\SearchChar\Model\Text;
use StasPiv\SearchChar\Model\State;

class TextHandlerTest extends TestCase
{
    /**
     * @var TextHandler
     */
    private $textHandler;

    protected function setUp()
    {
        parent::setUp();
        $this->textHandler = new TextHandler();
    }

    public function testGetChar()
    {
        $text = new Text('London is the capital of Great Britain');

        $text->setCurrentCharIndex(4);

        $this->assertEquals('o', $this->textHandler->getCurrentChar($text));
    }

    public function testCompareCurrentChars()
    {
        $text = new Text('London is the capital of Great Britain');
        $keyword = new Keyword('London');

        $text->setCurrentCharIndex(0);
        $keyword->setCurrentCharIndex(0);

        $reflectionMethod = new ReflectionMethod(TextHandler::class, 'compareCurrentChars');
        $reflectionMethod->setAccessible(true);

        $this->assertTrue($reflectionMethod->invokeArgs($this->textHandler, [$text, $keyword]));
        $keyword->setCurrentCharIndex(1);
        $this->assertFalse($reflectionMethod->invokeArgs($this->textHandler, [$text, $keyword]));
    }

    public function testProcess()
    {
        $testText = 'London is the capital of Great Britain';
        $testKeyword = 'London';

        $text = new Text($testText);
        $keyword = new Keyword($testKeyword);

        $this->assertProcessObjects($text->setCurrentCharIndex(0), $keyword->setCurrentCharIndex(0), State::OK);
        $this->assertProcessObjects($text->setCurrentCharIndex(0), $keyword->setCurrentCharIndex(1), State::FAIL);
        $this->assertProcessObjects($text->setCurrentCharIndex(6), $keyword->setCurrentCharIndex(0), State::FAIL);
    }

    public function testGetKeywordOccurrences()
    {
        $this->assertSearchOccurrences('London is the capital of Great Britain', 'London', 1);
        $this->assertSearchOccurrences('London, is the capital of Great Britain London', 'London', 2);
        $this->assertSearchOccurrences('Я помню чудное мгновенье', 'мгновенье', 1);
        $this->assertSearchOccurrences('There is in the insane', 'in', 1);
        $this->assertSearchOccurrences('is in: is in is in is in', 'is', 4);
        $this->assertSearchOccurrences('in is-; in is in is in is in', 'in', 5);
    }

    /**
     * @param Text $text
     * @param Keyword $keyword
     * @param int $expectedState
     */
    private function assertProcessObjects(Text $text, Keyword $keyword, int $expectedState)
    {
        $reflectionMethod = new ReflectionMethod(TextHandler::class, 'process');
        $reflectionMethod->setAccessible(true);

        $reflectionMethod->invokeArgs($this->textHandler, [$text, $keyword]);
        $this->assertEquals($expectedState, $keyword->getCurrentState());
    }

    /**
     * @param string $testText
     * @param string $testKeyword
     * @param string $expectedOccurrencesCount
     * @return void
     */
    private function assertSearchOccurrences(string $testText, string $testKeyword, string $expectedOccurrencesCount)
    {
        $text = new Text($testText);
        $keyword = new Keyword($testKeyword);

        $occurrences = $this->textHandler->searchOccurrences($text, $keyword);

        $this->assertEquals($expectedOccurrencesCount, count($occurrences));
    }
}