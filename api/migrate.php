<?php

chdir(__DIR__ . '/..'); // Move one directory up to the root of the Laravel project

// Include the Composer autoload file to access Laravel classes
require 'vendor/autoload.php';

// Run Laravel migrations
\Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
