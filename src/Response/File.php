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
use Fuel\Foundation\Exception\Forbidden;
use Fuel\Foundation\Exception\NotFound;

/**
 * Serve a file as a response
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class File extends Base
{
	/**
	 * @param string $file
	 * @param string $mime
	 * @param array  $headers
	 */
	public function __construct(\Fuel\FileSystem\File $file, array $headers = [])
	{
		// process the passed data

		if ( ! $file->exists())
		{
			throw new NotFound;
		}

		if ( ! $file->isReadable())
		{
			throw new Forbidden;
		}

		$this->setContentType($file->getMimeType());

		parent::__construct($file, 200, $headers);
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
		return $this->content->getContents();
	}
}
