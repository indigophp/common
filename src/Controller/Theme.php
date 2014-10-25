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
 * Theme Controller
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
trait Theme
{
	use Base
	{
		before as private __before;
	}

	/**
	 * {@inheritdoc}
	 */
	public function before()
	{
		$this->__before();

		$config = $this->request->getConfig();
		$finder = $this->app->getViewManager()->getFinder();

		$config->load('theme', true);

		$paths = $config->get('theme.paths', []);
		$theme = $config->get('theme.active', 'default');

		if ($config->get('theme.use_component_name', false))
		{
			$component = $this->request->getComponent()->getUri();
			$component = str_replace('/', DIRECTORY_SEPARATOR, trim($component, '/'));
		}

		foreach ($paths as $path)
		{
			$path .= DIRECTORY_SEPARATOR.$theme;

			if (isset($component))
			{
				$path .= DIRECTORY_SEPARATOR.$component;
			}

			$finder->addPath($path);
		}
	}
}
