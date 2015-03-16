<?php

/*
 * This file is part of the FuelPHP Menu package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Common;

use League\Container\ServiceProvider;
use League\Container\ContainerInterface;

/**
 * Provides permanent services which always get registered
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
abstract class PermanentServiceProvider extends ServiceProvider
{
	/**
	 * {@inheritdoc}
	 */
	public function provides($alias = null)
	{
		return false;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setContainer(ContainerInterface $container)
	{
		// Container is already set
		if ($this->container === $container)
		{
			return $this;
		}

		parent::setContainer($container);

		$this->register();

		return $this;
	}
}
