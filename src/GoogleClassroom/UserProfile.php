<?php

namespace GoogleClassroomEike\GoogleClassroom;

use GoogleClassroomEike\GoogleClassroom\ClientBase;
use GuzzleHttp\Psr7\Request;


class UserProfile extends ClientBase
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @throws \Exception()
	 */
	public function getUserProfile($token)
	{
		try{
			$url = 'https://classroom.googleapis.com/v1/userProfiles/me';
			$headers = [
				'Authorization' => 'Bearer '.$token,
				'Content-Type' => 'application/json',
			];
			$request = new Request('GET', $url, $headers);
			$res = $this->client->send($request);
			return $res->getBody()->getContents();

		}catch (\Exception $e){
			throw new \Exception($e->getMessage(),$e->getCode());
		}
	}

}