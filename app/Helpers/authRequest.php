<?php

namespace App\Helpers;

use HNG\Http\Exception\InvalidRequest;

class AuthRequest {

	/** 
	* @var 
	*/
	private $client;

	/** 
	* @var 
	*/
	private $params;

	/** 
	* @var 
	*/
	private $appName;

	/** 
	* @var 
	*/
	// private $appUuid;

	public function __construct()
	{
		$this->appName = defined('AUTH_APP_NAME') ? AUTH_APP_NAME : 'Panel';

		// $this->appUuid = env('AUTH_APP_UUID');

		$this->params['application'] = $this->appName;

		$this->client = new Request;
	}

	/**
	* Log In User
	*
	* @param array $credentials - [email|password|otp*]
	* @return array
	*/
	public function login(array $credentials)
	{
		try {
			$payload = array_merge($credentials, $this->params);
			
			$response = Utilities::format_response($this->client->post('/auth/users/login', $payload));

			return $response;
		}
		catch(InvalidRequest $e) {
			return Utilities::format_response($e->getRequestResponse());
		}
	}

	public function addUser($payload)
	{
		$payload = array_merge($payload, $this->params);

		$response = Utilities::format_response($this->client->post('/auth/users', $payload));

		return $response;
	}

	public function getUser($email)
	{
		$response = Utilities::format_response($this->client->get("/auth/users/{$email}"));

		return $response;
	}

	public function addUserPermission($payload)
	{
		$payload = array_merge($payload, $this->params);
		$payload = ['form_params' => $payload];
		$response = Utilities::format_response($this->client->post('/auth/users/permissions/add', $payload));

		return $response;
	}

	public function deleteUserPermission()
	{
		$method = 'POST';
		$url = '/user/permissions/delete';
		$payload = ['form_params' => $this->params];
		$result = $this->sendRequest($method,$url,$payload);
		return $result;
	}

	public function editUserPermission($payload)
	{
		$payload = array_merge($payload, $this->params);
		$payload = ['form_params' => $payload];
		$response = Utilities::format_response($this->client->post('/auth/users/permissions/edit', $payload));

		return $response;
	}

	public function getAllUsers()
	{
		$response = Utilities::format_response($this->client->get("/auth/{$this->appName}/users"));
		return $response;
	}
	
}
