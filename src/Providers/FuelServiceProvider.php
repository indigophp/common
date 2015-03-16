<?php

/*
 * This file is part of the Indigo Common package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Common\Providers;

use League\Container\ServiceProvider;
use Fuel\FileSystem\File;
use Indigo\Common\Response;

/**
 * Provides common services
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class FuelServiceProvider extends ServiceProvider
{
	/**
	 * @var array
	 */
	protected $provides = [
		'response.file',
		'response.content',
	];

	/**
	 * {@inheritdoc}
	 */
	public function register()
	{
		$this->container->add('response.file', function (File $file, array $headers = [])
		{
			return new Response\File($file, $headers);
		});

		$this->container->add('response.content', function ($content = '', $contentType = 'application/octet-stream', $status = 200, array $headers = [])
		{
			return new Response\Content($content, $contentType, $status, $headers);
		});
	}
}
