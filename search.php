<?php
/**
 * Created by search-char.
 * User: ssp
 * Date: 16.08.16
 * Time: 13:25
 */

require_once 'vendor/autoload.php';

use StasPiv\SearchChar\Handler\TextHandler;
use StasPiv\SearchChar\Model\Keyword;
use StasPiv\SearchChar\Model\Text;

$testText = 'London is the capital of Great Britain London';
$testKeyword = 'London';

$text = new Text($testText);
$keyword = new Keyword($testKeyword);

$textHandler = new TextHandler();

$occurrences = $textHandler->searchOccurrences($text, $keyword);