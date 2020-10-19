<?php

function imatic_sentry_options(): ?array {
	$dsn = getenv('IMATIC_SENTRY_DSN');
	if ($dsn === false) {
		return null;
	}
	
	return [
		'dsn' => getenv('IMATIC_SENTRY_DSN'),
		'release' => getenv('IMATIC_SENTRY_RELEASE') ?: null
	];
}

function imatic_sentry_init() {
	$options = imatic_sentry_options();
	if ($options === null) {
		return;
	}

	Sentry\init($options);
}

imatic_sentry_init();
