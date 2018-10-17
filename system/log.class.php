<?php

class Log {

    private $levels = array(
        'DEBUG' => 100,
        'INFO' => 200,
        'NOTICE' => 250,
        'WARNING' => 300,
        'ERROR' => 400,
        'CRITICAL' => 500,
        'ALERT' => 550,
        'EMERGENCY' => 600,
    );

    private $level;

    public function __construct($level = 'INFO') {
        $this->level = $this->cleanLevelInt($level);
    }

    public function message($level, $message, $context = null) {
        $lev = $this->cleanLevelInt($level);
        if ($this->shouldLog($lev)) {
            $this->write($lev, $message, $context);
        }
    }

    public function debug($message, $context = null) {
        $this->message('DEBUG', $message, $context);
    }

    public function info($message, $context = null) {
        $this->message('INFO', $message, $context);
    }

    public function notice($message, $context = null) {
        $this->message('NOTICE', $message, $context);
    }

    public function warning($message, $context = null) {
        $this->message('WARNING', $message, $context);
    }

    public function error($message, $context = null) {
        $this->message('ERROR', $message, $context);
    }

    public function critical($message, $context = null) {
        $this->message('CRITICAL', $message, $context);
    }

    public function alert($message, $context = null) {
        $this->message('ALERT', $message, $context);
    }

    public function emergency($message, $context = null) {
        $this->message('EMERGENCY', $message, $context);
    }

    private function cleanLevelInt($level) {
        $intLevel = intval($level);
        if (in_array($intLevel, array_values($this->levels))) {
            return $intLevel;
        } elseif (array_key_exists(strtoupper($level), $this->levels)) {
            return $this->levels[strtoupper($level)];
        } else {
            $this->critical('Unknown log level ' . $level);
            return 500; // Critival
        }
    }

    private function levelIntToStr($levelInt) {
        $flipped = array_flip($this->levels);
        return $flipped[$levelInt];
    }

    private function shouldLog($levelInt) {
        return $levelInt >= $this->level;
    }

    private function write($level, $message, $context = null) {
        // Just send message to default error handling.
        // Could just as easily to write some file or something else.
        $levelStr = $this->levelIntToStr($level);
        $msg = $levelStr . ': ' . $message;

        if ($context !== null) {
            $msg .= ' ' . json_encode($context);
        }

        error_log($msg);
    }
}
