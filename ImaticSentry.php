<?php
declare(strict_types=1);

require_api('http_api.php');

class ImaticSentryPlugin extends MantisPlugin
{
	public function register(): void
	{
		$this->name = 'Imatic Sentry';
		$this->description = 'Error reporting';
		$this->version = '0.0.1';
		$this->requires = [
			'MantisCore' => '2.0.0',
		];

		$this->author = 'Imatic Software s.r.o.';
		$this->contact = 'info@imatic.cz';
		$this->url = 'https://www.imatic.cz/';
	}

	public function hooks(): array
	{
		return [
			'EVENT_CORE_HEADERS' => 'core_headers_hook',
			'EVENT_LAYOUT_RESOURCES' => 'layout_resources_hook',
		];
	}

	public function core_headers_hook()
	{
		$options = imatic_sentry_options();
		if ($options === null) {
			return;
		}

		http_csp_add('default-src', parse_url($options['dsn'], PHP_URL_HOST));
	}

	public function layout_resources_hook() 
	{
		$options = imatic_sentry_options();
		if ($options === null) {
			return;
		}

		return '<script type="text/javascript" src="' . plugin_page('sentry-options') . '"></script>'
		. '<script type="text/javascript" src="' . plugin_file('sentry.js') . '&v=' . $this->version . '"></script>';
	}
}
