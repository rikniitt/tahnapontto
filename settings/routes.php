<?php

/**
 * Define application routes.
 */

// Some basic hello world example
respond('GET', '/hello/[:world]', function($request, $response, $app) {
    echo "Matched GET /hello/[:world]<br />";
    echo "Hello " . $request->world ."<br />";
    $query = $app->db->query('SELECT now() AS PDO_Hello_World');
    $row = $query->fetch(PDO::FETCH_ASSOC);
    echo "MySQL now() = " . $row['PDO_Hello_World'] . '<br />';
});


// Example for moving the logic to "controllers"
respond('GET', '/add', function($request, $response, $app) {
    $app->textFilesController->showAddForm();
});
respond('POST', '/textfile/save', function($request, $response, $app) {
    $app->textFilesController->saveNewTextFile();
});
respond('GET', '/show/[:textFileId]', function($request, $response, $app) {
    $app->textFilesController->showTextFile($request->textFileId);
});
respond('GET', '/list', function($request, $response, $app) {
    $app->textFilesController->showAll();
});
respond('GET', '/download/[:textFileId]', function($request, $response, $app) {
    $app->textFilesController->downloadTextFile($request->textFileId);
});


// Default index
respond('GET', '/?', function($request, $response, $app) {
    // Logging example
    $app->log->debug('Index page loaded by', array(
        'ip' => $request->ip(),
        'userAgent' => $request->userAgent()
    ));

    $latest = Model::factory('TextFileModel')
                   ->filter('latest')->findMany();

    $response->layout(VIEW_DIR . '/layout/master.php');
    $response->render(VIEW_DIR . '/home.php', array(
        'latestTextFiles' => $latest
    ));
});
