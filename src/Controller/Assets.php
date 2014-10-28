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

use Indigo\Common\Mimetypes;
use Fuel\Foundation\Controller\Base;
use Fuel\Foundation\Exception\Forbidden;
use Fuel\Foundation\Exception\NotFound;

/**
 * Assets Controller
 *
 * Serve assets from protected folders
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Assets extends Base
{
	/**
	 * Catches all calls and handles theme asset requests
	 */
	public function actionIndex()
	{
		list($theme, $file) = func_get_args();

		// Invalid path, STOP HACKING
		if(false !== strpos($file, '..'))
		{
			throw new Forbidden;
		}

		$file = realpath(DOCROOT.'../themes/'.$theme.'/assets/'.$file);

		if ( ! file_exists($file))
		{
			throw new NotFound;
		}

		if ( ! is_readable($file))
		{
			throw new Forbidden;
		}

		$mime = Mimetypes::fromFilename($file);
		$content = file_get_contents($file);

		return \Response::forge('content', $content, $mime);
	}
}
