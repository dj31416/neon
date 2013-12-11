<?php

/**
 * Test: Nette\Utils\Tokenizer::tokenize with names
 *
 * @author     David Grudl
 * @package    Nette\Utils
 */

use Nette\Utils\Tokenizer,
	Tester\Assert;


require __DIR__ . '/../bootstrap.php';


$tokenizer = new Tokenizer(array(
	'number' => '\d+',
	'whitespace' => '\s+',
	'string' => '\w+',
));
$tokenizer->tokenize("say \n123");
Assert::same( array(
	array('value' => 'say', 'type' => 'string', 'line' => 1),
	array('value' => " \n", 'type' => 'whitespace', 'line' => 1),
	array('value' => '123', 'type' => 'number', 'line' => 2),
), $tokenizer->tokens );

Assert::exception(function() use ($tokenizer) {
	$tokenizer->tokenize('say 123;');
}, 'Nette\Utils\TokenizerException', "Unexpected ';' on line 1, column 8.");