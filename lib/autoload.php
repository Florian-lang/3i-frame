<?php

const ALIASES = [
	'iFrame' => 'lib',
	'App' => 'src'
];

spl_autoload_register(function (string $class): void {
    $namespaces = explode("\\",$class);

    if (in_array($namespaces[0], array_keys(ALIASES))) {
		$namespaces[0] = ALIASES[$namespaces[0]];
	} else {
		throw new Exception('Namespace « ' . $namespaces[0] . ' » invalide. Un namespace doit commencer par : « iFrame » ou « App »');
	}

    $filepath = dirname(__DIR__) . '/' . implode('/', $namespaces) . '.php';
	if (!file_exists($filepath)) {
		throw new Exception("Fichier « " . $filepath . " » introuvable pour la classe « " . $class . " ». Vérifier le chemin, le nom de la classe ou le namespace");
	}
	require $filepath;
});