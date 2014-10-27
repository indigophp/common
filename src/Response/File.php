<?php

/*
 * This file is part of the Indigo Common package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Common\Response;

use Fuel\Foundation\Response\Base;
use Fuel\Foundation\Exception\NotFound;

/**
 * Serve a file as a response
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class File extends Base
{
	/**
	 * File to serve
	 *
	 * @var \Fuel\FileSystem\File
	 */
	protected $file;

	/**
	 * @param string $file
	 * @param string $mime
	 * @param array  $headers
	 */
	public function __construct(\Fuel\FileSystem\File $file, array $headers = [])
	{
		// process the passed data
		$this->file = $file;

		if ( ! $file->exists())
		{
			throw new NotFound;
		}

		if ( ! $file->isReadable())
		{
			throw new Forbidden;
		}

		$this->setContentType($file->getMimeType());

		foreach ($headers as $k => $v)
		{
			$this->setHeader($k, $v);
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function sendContent()
	{
		echo $this->__toString();

		return $this;
	}

	/**
	 * Returns the body as a string
	 *
	 * @return string
	 */
	public function __toString()
	{
		return $this->file->getContents();
	}
}
