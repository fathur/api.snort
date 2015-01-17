<?php

/**
* 
*/
class ApiController extends BaseController
{
	
	protected $statusCode = 200;

	public function getStatusCode()
	{
		return $this->statusCode;
	}

	public function setStatusCode($statusCode)
	{
		$this->statusCode = $statusCode;
	}


	public function respond($data, $headers = [] )
	{
		return Response::json($data, $this->statusCode, $headers);
	}

	public function respondWithError($message)
	{
		return $this->respond([
			'error'	=> [
				'message'		=> $message,
				'status_code'	=> $this->getStatusCode()
			]
		]);
	}
	
	/**
	 * [respondNotFound description]
	 * @param  string $message [description]
	 * @return [type]          [description]
	 */
	public function respondNotFound($message = "Not Found")
	{
		return $this->setStatusCode(404)->respondWithError($message);
	}

	/**
	 * [respondInternalError description]
	 * @param  string $message [description]
	 * @return [type]          [description]
	 */
	public function respondInternalError($message = "Internal Error!")
	{
		return $this->setStatusCode(500)->respondWithError($message);
	}

	public function respondCreated($message = "Created!")
	{
		return $this->setStatusCode(201)->respondWithError($message);
		
	}
}