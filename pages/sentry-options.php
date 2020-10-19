<?php
header('Content-Type: application/javascript');
header('Cache-Control: no-store');

echo 'window.IMATIC_SENTRY_OPTIONS = ' . json_encode(imatic_sentry_options()) . ';';
