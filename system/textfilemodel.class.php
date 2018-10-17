<?php

/**
 * Assumes following db table
    CREATE TABLE textFiles (
      id VARCHAR(128) PRIMARY KEY,
      name VARCHAR(64) NOT NULL,
      content TEXT,
      type VARCHAR(8) DEFAULT 'txt',
      visibleOnlyWithLink TINYINT(1) UNSIGNED DEFAULT 0,
      createdAt DATETIME,
      validUntil DATETIME DEFAULT '9999-12-31 23:59:59'
    );
 */
class TextFileModel extends Model {
    public static $_table = 'textFiles';
    public static $_id_column = 'id';

    public function generateId() {
        if ($this->id) {
            return;
        }

        do {
            $id = uniqid();
        } while (Model::factory('TextFileModel')->where('id', $id)->findOne());

        $this->id = $id;
    }

    // Some ad-hoc validation
    public function validationErrors() {
        $errors = array();

        if (!$this->name) {
            $errors[] = 'Tiedoston nimi on pakollinen';
        }

        if (!$this->content) {
            $errors[] = 'Tiedoston sisältö ei voi olla tyhjä';
        }

        if ($this->visibleOnlyWithLink !== 0 && $this->visibleOnlyWithLink !== 1) {
            $errors[] = 'Valitse joko pääsy vain linkillä tai ei';
        }

        if ($this->validUntil === '') {
            $errors[] = 'Viallinen vanhentumispäivämäärä';
        }

        return $errors;
    }

    // Example of paris filters
    //  http://paris.readthedocs.io/en/latest/filters.html#filters
    public static function latest($orm, $howMany = 6) {
        $now = new DateTime();

        return $orm->whereNotEqual('visibleOnlyWithLink', 1)
                   ->whereGte('validUntil', $now->format('Y-m-d H:i:s'))
                   ->orderByDesc('createdAt')
                   ->limit($howMany);
    }

    public static function visible($orm) {
        $now = new DateTime();

        return $orm->whereNotEqual('visibleOnlyWithLink', 1)
                   ->whereGte('validUntil', $now->format('Y-m-d H:i:s'));
    }

    // Helper function to get lenght of the content
    public function contentLength() {
        return mb_strlen($this->content);
    }

    public function contentLengthHuman() {
        $size = $this->contentLength();
        $units = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
        $step = 1024;
        $i = 0;

        while (($size / $step) > 0.9) {
            $size = $size / $step;
            $i++;
        }

        return round($size, 2) . $units[$i];
    }

    public function isStillValid() {
        $now = new DateTime();
        $validUntil = DateTime::createFromFormat('Y-m-d H:i:s', $this->validUntil);

        return ($validUntil && $now <= $validUntil);
    }
}
