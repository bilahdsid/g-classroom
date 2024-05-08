<?php

namespace GoogleClassroomEike\GoogleClassroom;


use GuzzleHttp\Client;

class ClientBase
{
	protected $client;

	protected $token;

	protected $user;

	public function __construct()
	{
		$this->client = new Client();
	}

}