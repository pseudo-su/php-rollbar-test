<?php

include __DIR__ . '/../vendor/autoload.php';

use \Rollbar\Rollbar;
use \Rollbar\Payload\Level;
use \Dotenv\Dotenv;
use Cekurte\Environment\Environment;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..', '.env.local');
$dotenv->load();
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$rollbarAccessToken = Environment::get("ROLLBAR_ACCESS_TOKEN");
$rollbarEnvironment = Environment::get("ROLLBAR_ENVIRONMENT", "development");

echo "Using access_token: $rollbarAccessToken\n";
echo "Using environment: $rollbarEnvironment\n";

// Configure rollbar
Rollbar::init(
    array(
        'access_token' => $rollbarAccessToken,
        'environment' => $rollbarEnvironment,
    )
);

// Send rolbar test data
Rollbar::log(Level::info(), 'Test info message');
throw new Exception('Test exception');
