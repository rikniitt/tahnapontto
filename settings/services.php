<?php

/**
 * Register services to application.
 * Services are accessible via $app.
 *   https://github.com/klein/klein.php/tree/v1.2.0#lazy-services
 */

respond(function($request, $response, $app) {
    // Register service 'db' to the $app.
    // It is accessible via $app->db later.
    // Note, that register creates singleton, so
    // the same Db instance is returned each time.
    $app->register('db', function() {
        return new Db();
    });
});

respond(function($request, $response, $app) {
    $app->register('log', function() {
        return new Log(LOG_LEVEL);
    });
});

respond(function($request, $response, $app) {
    $app->register('urlhelp', function() {
        return new UrlHelper();
    });

    $response->urlhelp = $app->urlhelp;
});

respond(function($request, $response, $app) {
    $app->register('textFilesController', function() use ($request, $response, $app) {
        return new TextFilesController($request, $response, $app);
    });
});
