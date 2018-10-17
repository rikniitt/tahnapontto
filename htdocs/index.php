<?php

require __DIR__ . '/../settings/setup.php';

// Hack to support deployment elsewhere than
// domain level docroot, like domain.com/~riku/klein
$phpSelf = $_SERVER['PHP_SELF'];
$phpSelfPath = pathinfo($phpSelf, PATHINFO_DIRNAME);

if ($phpSelfPath !== '/') {
    dispatch(substr($_SERVER['REQUEST_URI'], strlen($phpSelfPath)));
} else {
    // just
    dispatch();
}
