<?php

/*
 * This file is part of the FuelPHP Menu package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Common\Providers;

use Fuel\FileSystem\File;
use Fuel\Dependency\ServiceProvider;

/**
 * Provides menu services
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class FuelServiceProvider extends ServiceProvider
{
	/**
	 * {@inheritdoc}
	 */
	public $provides = [
		'response.file',
		'response.content',
	];

	/**
	 * {@inheritdoc}
	 */
	public function provide()
	{
		$this->register('response.file', function ($dic, File $file, array $headers = [])
		{
			return $dic->resolve('Indigo\Common\Response\File', [$file, $headers]);
		});

		$this->extend('response.file', 'getRequestInstance');

		$this->register('response.content', function ($dic, $content = '', $contentType = 'application/octet-stream', $status = 200, array $headers = [])
		{
			return $dic->resolve('Indigo\Common\Response\Content', [$content, $contentType, $status, $headers]);
		});

		$this->extend('response.content', 'getRequestInstance');
	}
}
