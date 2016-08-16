Usage:

<?php

use StasPiv\SearchChar\Handler\TextHandler;
use StasPiv\SearchChar\Model\Keyword;
use StasPiv\SearchChar\Model\Text;

$testText = 'London is the capital of Great Britain';
$testKeyword = 'London';

$text = new Text($testText);
$keyword = new Keyword($testKeyword);

$textHandler = new TextHandler();

$occurrences = $textHandler->searchOccurrences($text, $keyword);

// return array of Occurrence objects