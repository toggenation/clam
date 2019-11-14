<?php

namespace App\Exception;
use Cake\Log\LogTrait;

use Cake\Network\Exception\UnauthorizedException;


class TgnUnauthorizedException extends UnauthorizedException {

	protected $_defaultCode = 401;


	public function __construct($message = null, $code = null, $previous = null)
	{

			if (empty($message)) {
					$message = 'Unauthorized';
			}

			parent::__construct($message, $code, $previous);

			$this->responseHeader( "Access-Control-Allow-Origin", "*");
	}

}
