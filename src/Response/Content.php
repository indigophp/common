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

/**
 * Return any content
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Content extends Base
{
	/**
	 * @param string  $content
	 * @param string  $contentType
	 * @param integer $status
	 * @param array   $headers
	 */
	public function __construct(
		$content = '',
		$contentType = 'application/octet-stream',
		$status = 200,
		array $headers = []
	) {
		$this->setContentType($contentType);

		parent::__construct($content, $status, $headers);
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
		return $this->content;
	}
}
