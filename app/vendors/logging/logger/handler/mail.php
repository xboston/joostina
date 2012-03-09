<?php

defined('_JOOS_CORE') or die;

class joosLoggingHandlerMail extends joosLoggingHandler {

	public function __construct($options = array())
	{
		$this->_options	= array(
			'to'		=> 'mail@example.com',
			'subject'	=> 'Message from monolog',
			'from'		=> 'mail@example.com',
			'level'		=> joosLoggingLevels::ERROR
		);

		parent::__construct($options);

		$this->_handler	= new \Monolog\Handler\NativeMailerHandler($this->_options['to'], $this->_options['subject'],
			$this->_options['from'], $this->_options['level']);
	}

}