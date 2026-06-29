<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

// Setup & Deployment Helper Route
Route::get('/run-setup', function () {
    try {
        $output = "";

        // 1. Clear Route Cache
        Artisan::call('route:clear');
        $output .= "Route cache cleared:\n" . Artisan::output() . "\n";

        // 2. Clear Config Cache
        Artisan::call('config:clear');
        $output .= "Config cache cleared:\n" . Artisan::output() . "\n";

        // 3. Clear Cache
        Artisan::call('cache:clear');
        $output .= "Application cache cleared:\n" . Artisan::output() . "\n";

        // 4. Run Migrations
        Artisan::call('migrate', ['--force' => true]);
        $output .= "Database migrated:\n" . Artisan::output() . "\n";

        // 5. Seed Database
        Artisan::call('db:seed', ['--force' => true]);
        $output .= "Database seeded successfully:\n" . Artisan::output() . "\n";

        return response($output, 200)->header('Content-Type', 'text/plain; charset=utf-8');
    } catch (\Exception $e) {
        return response("Setup Error: " . $e->getMessage(), 500)->header('Content-Type', 'text/plain; charset=utf-8');
    }
});

Route::get('{any}', function () {
    return view('welcome');
})->where('any', '.*');
