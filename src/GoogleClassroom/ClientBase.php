<?php

namespace GoogleClassroomEike\GoogleClassroom;


use Google_Client;
use GuzzleHttp\Client;

class ClientBase
{
	protected Client $client;

	protected $accessToken;

	protected $user;

	protected $gClient;

	public function __construct()
	{
		$this->client = new Client();
		$this->gClient = new Google_Client();
	}

	protected function setAccessToken($token)
	{
		$this->accessToken = $token;
	}

	protected function transformResponse($response){
		return json_decode($response,true);
	}

}