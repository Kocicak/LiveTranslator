<?php

use Tester\Assert;
$container = require __DIR__ . '/bootstrap.application.php';

require __DIR__.'/storage/dummy.php';

Assert::exception(function() use($container){
	new \LiveTranslator\Translator('', new DummyStorage, $container->session, $container->application);
}, 'LiveTranslator\TranslatorException');

$trans = new \LiveTranslator\Translator('en', new DummyStorage, $container->session, $container->application);

$trans->setAvailableLanguages(array(
	'en', 'cz'
));

Assert::exception(function() use($trans){
	$trans->setCurrentLang('de');
}, 'LiveTranslator\TranslatorException');

Assert::exception(function() use($trans){
	$trans->setDefaultLang('de');
}, 'LiveTranslator\TranslatorException');

$trans = new \LiveTranslator\Translator('de', new DummyStorage(), $container->session, $container->application);

Assert::exception(function() use($trans){
	$trans->setAvailableLanguages(array(
		'en', 'cz'
	));
}, 'LiveTranslator\TranslatorException');

$trans = new \LiveTranslator\Translator('en', new DummyStorage(), $container->session, $container->application);

$trans->setCurrentLang('de');

Assert::exception(function() use($trans){
	$trans->setAvailableLanguages(array(
		'en', 'cz'
	));
}, 'LiveTranslator\TranslatorException');
