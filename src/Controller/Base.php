<?php

/*
 * This file is part of the Indigo Common package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Common\Controller;

use LogicException;

/**
 * Base Controller
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
trait Base
{
	/**
	 * {@inheritdoc}
	 */
	public function before()
	{
		if ( ! $this instanceof \Fuel\Foundation\Controller\Base)
		{
			throw new LogicException('Controller must extend Fuel\Foundation\Controller\Base');
		}
	}
}
