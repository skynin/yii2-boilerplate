<?php

namespace common\tests;

/**
 *
 * @author Skynin <sohay_ua@yahoo.com>
 * created: 07-May-2018
 */
trait OutputConsoleTrait
{
	public function outputConsole( $messages )
	{
		static $output;
		if (empty($output)) {
			$output = new \Codeception\Lib\Console\Output([]);
			$output->writeln('');
		}

		$output->writeln(is_string($messages) ? $messages : print_r($messages, TRUE));
	}
}
