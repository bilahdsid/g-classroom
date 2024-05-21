<?php

namespace GoogleClassroomEike\GoogleClassroom;


use GuzzleHttp\Client;

class ClientBase
{
	protected Client $client;

	protected $accessToken;

	protected $user;

	public function __construct()
	{
		$this->client = new Client();
	}

	protected function setAccessToken($token)
	{
		$this->accessToken = $token;

	}

	protected function transformResponse($response){
		return json_decode($response,true);
	}

}