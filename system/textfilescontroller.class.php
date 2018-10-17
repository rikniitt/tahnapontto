<?php

class TextFilesController {
    private $request;
    private $response;
    private $app;

    private $fileTypes = array(
        'txt',
        'php',
        'js',
        'html',
        'css',
        'sh',
        'sql',
        'json',
        'py',
        'pl'
    );

    public function __construct($request, $response, $app) {
        $this->request = $request;
        $this->response = $response;
        $this->app = $app;
    }

    public function showAddForm() {
        $this->response->layout(VIEW_DIR . '/layout/master.php');
        $this->response->render(VIEW_DIR . '/add-new-textfile.php', array(
            'fileTypes' => $this->fileTypes,
            'validationErrors' => $this->response->flashes('validationErrors'),
        ));
    }

    public function saveNewTextFile() {
        $this->app->log->debug('POST /textfile/save received', $this->request->params());
        $new = Model::factory('TextFileModel')->create();

         // Handles the id field generation in our custom model
        $new->generateId();

        $new->name = $this->request->name;
        $new->content = $this->request->content;
        $new->type = $this->request->type;
        $new->visibleOnlyWithLink = intval($this->request->visibleOnlyWithLink);
        $valid = new DateTime($this->request->validUntil);
        $new->validUntil = ($valid) ? $valid->format('Y-m-d H:i:s') : '';
        $now = new DateTime();
        $new->createdAt = $now->format('Y-m-d H:i:s');

        $this->app->log->debug('Preparing to save new text file', $new->asArray());
        $validationErrors = $new->validationErrors();

        if (count($validationErrors) || !$new->save()) {
            foreach ($validationErrors as $err) {
                $this->response->flash($err, 'validationErrors');
            }

            $this->app->log->info('Failed to save new text file', array(
                'requestParams' => $this->request->params(),
                'validationErrors' => $validationErrors,
                'textFile' => $new->asArray()
            ));

            $this->response->redirect(
                $this->app->urlhelp->path('/add')
            );
        } else {
            // Success. Show the created textfle
            $this->app->log->info('Saved new text file', $new->asArray());
            $this->response->redirect(
                $this->app->urlhelp->path('/show/' . $new->id)
            );
        }
    }

    public function showTextFile($id) {
        $file = Model::factory('TextFileModel')->findOne($id);

        if (!$file || !$file->isStillValid()) {
            $this->response->code(404);
            echo "<pre>Tiedostoa ei löytynyt</pre>";
        } else {
            $this->response->layout(VIEW_DIR . '/layout/master.php');
            $this->response->render(VIEW_DIR . '/show-textfile.php', array(
                'textFile' => $file
            ));
        }
    }

    public function showAll() {
        $all = Model::factory('TextFileModel')
                    ->filter('visible')
                    ->orderByDesc('createdAt')
                    ->findMany();

        $this->response->layout(VIEW_DIR . '/layout/master.php');
        $this->response->render(VIEW_DIR . '/list-textfiles.php', array(
            'textFiles' => $all
        ));
    }

    public function downloadTextFile($id) {
        $file = Model::factory('TextFileModel')->findOne($id);

        if (!$file || !$file->isStillValid()) {
            $this->response->code(404);
            echo "<pre>Tiedostoa ei löytynyt</pre>";
        } else {
            // this is not right
            $tmpfile = tempnam('/tmp', 'klein_example');
            file_put_contents($tmpfile, $file->content);

            $this->response->file($tmpfile, $file->name);
        }
    }
}
