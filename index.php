<?php

require "vendor/autoload.php";
require "init.php";

use Klein\Klein as Route;

try {

    $route = new Route();

    // Route for static assets (e.g., CSS, JS, images)
    $route->with('/assets', function ($route) {
        $route->respond('GET', '/[*]', function ($request) {
            $filePath = __DIR__ . '/assets/' . $request->param('*');
            if (file_exists($filePath)) {
                return file_get_contents($filePath);
            }
            return 'File not found';
        });
    });

    // Route for founder pages
    $route->get('/founder/[s:format]', ['App\ProfileHandler', 'display']);

    $route->dispatch();

} catch (Exception $e) {

    err('ERROR ' . $e->getMessage());
    echo json_encode([
        'error' => $e->getMessage()
    ]);
}
