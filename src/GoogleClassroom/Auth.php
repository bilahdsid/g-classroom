<?php

namespace GoogleClassroomEike\GoogleClassroom;

use GuzzleHttp\Psr7\Request;

class Auth extends ClientBase
{
	private $clientId;
	private $redirectUri;

	private $clientSecret;
	/**
	 * @throws \Exception
	 */
	public function __construct($clientId = null, $clientSecret = null,$responseType = null, $redirectUri = null, $scope= null)
	{
		parent::__construct();
		$this->clientId = $clientId;
		$this->redirectUri = $redirectUri;
		$this->clientSecret = $clientSecret;
	}

	/**
	 * @throws \Exception
	 */
	public function getAuthCode($responseType,$scope)
	{
		try{
			$url = "https://accounts.google.com/o/oauth2/v2/auth";
			$request = new Request('GET', $url.'?client_id='.$this->clientId.'&response_type='.$responseType.'&redirect_uri='.$this->redirectUri.'&scope='.$scope);
			$res = $this->client->send($request);
			return $res->getBody()->getContents();
		}catch (\Exception $e){
			throw new \Exception($e->getMessage());
		}
	}

	/**
	 * @throws \Exception
	 */
	public function getBearerToken($grantType,$code)
	{
		try{
			$url = 'https://oauth2.googleapis.com/token';
			$headers = [
				'Content-Type' => 'application/x-www-form-urlencoded'
			];
			$options = [
				'form_params' => [
					'grant_type' => $grantType,
					'client_id' => $this->clientId,
					'client_secret' => $this->clientSecret,
					'redirect_uri' => $this->redirectUri,
					'code' => $code
				]];

			$request = new Request('POST', $url, $headers);
			$res = $this->client->send($request, $options);
			$payload = json_decode($res->getBody()->getContents());
			$this->token = $payload->access_token;
			return $payload;
		}catch (\Exception $e){
			throw new \Exception($e->getMessage(),$e->getCode());
		}
	}

	/**
	 * @throws \Exception
	 */
	public function getUser($token)
	{
		try{
			$url = 'https://oauth2.googleapis.com/oauth2/v1/userinfo';

			$headers = [
				'Authorization' => 'Bearer '.$token
			];
			$request = new Request('GET', 'https://www.googleapis.com/oauth2/v1/userinfo', $headers);
			$res = $this->client->send($request);
			$this->user  = json_decode($res->getBody()->getContents());
			return $this->user;
		}catch (\Exception $e){
			throw new \Exception($e->getMessage(),$e->getCode());
		}

	}

}
