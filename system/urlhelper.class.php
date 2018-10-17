<?php

/**
 * Simple helper class to handle links
 * in this demo, when document root
 * is not "at the domain level"
 * eg. index.php is on ulr http://localhost/some/fold/index.php
 */
class UrlHelper {

    public function to($path) {
        $self = $_SERVER['PHP_SELF'];
        $selfPath = pathinfo($self, PATHINFO_DIRNAME);

        if ($selfPath === '/') {
            $selfPath = '';
        }

        $scheme = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];

        return $scheme . '://' . $host . $selfPath . '/' . ltrim($path, '/');
    }

    public function path($path) {
        $self = $_SERVER['PHP_SELF'];
        $selfPath = pathinfo($self, PATHINFO_DIRNAME);

        if ($selfPath === '/') {
            $selfPath = '';
        }

        return $selfPath . '/' . ltrim($path, '/');
    }
}
