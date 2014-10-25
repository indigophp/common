<?php

/*
 * This file is part of the FuelPHP Common package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Monolog\Handler;

use Fuel\Session\Manager;
use Monolog\Logger;
use Monolog\Formatter\AlertFormatter;

/**
 * Handle flash messages
 *
 * @author Márk-Sági-Kazár <mark.sagikazar@gmail.com>
 */
class FlashHandler extends AbstractProcessingHandler
{
	/**
	 * Session Manager
	 *
	 * @var Manager
	 */
	protected $session;

	/**
	 * @param Manager $session
	 * @param integer $level
	 * @param boolean $bubble
	 */
	public function __construct(Manager $session, $level = Logger::INFO, $bubble = true)
	{
		$this->session = $session;

		parent::__construct($level, $bubble);
	}

	/**
	 * {@inheritdocs}
	 */
	protected function write(array $record)
	{
		$this->session->setFlash('alert.'.$this->getTemplate($record), $record);
	}

	/**
	 * Returns the template name
	 *
	 * @param array $record
	 *
	 * @return string
	 */
	protected function getTemplate(array $record)
	{
		$template = isset($record['context']['template']) ? $record['context']['template'] : $record['level_name'];

		return strtolower($template);
	}
}
