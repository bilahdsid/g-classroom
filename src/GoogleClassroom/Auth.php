<?php

namespace GoogleClassroomEike\GoogleClassroom;

use Google\Service\Oauth2;
use Google_Client;
use Google_Service_Classroom;
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

	public function getAuthCodeSdk()
	{
		// Create a new Google_Client instance
		$gClient = new Google_Client();
		$gClient->setClientId($this->clientId);
		$gClient->setClientSecret($this->clientSecret);
		$gClient->setRedirectUri($this->redirectUri);
		//$gClient->setRedirectUri("urn:ietf:wg:oauth:2.0:oob");
		//$gClient->setAuthConfig(['client_id'=>$this->clientId,'client_secret'=>$this->clientSecret,'redirect_uris'=>$this->redirectUri]);


		$gClient->addScope([Oauth2::OPENID,Oauth2::USERINFO_EMAIL,Google_Service_Classroom::CLASSROOM_PROFILE_EMAILS,Google_Service_Classroom::CLASSROOM_PROFILE_PHOTOS,Google_Service_Classroom::CLASSROOM_COURSES,Google_Service_Classroom::CLASSROOM_ANNOUNCEMENTS,Google_Service_Classroom::CLASSROOM_COURSEWORK_ME,Google_Service_Classroom::CLASSROOM_COURSEWORK_STUDENTS,Google_Service_Classroom::CLASSROOM_TOPICS,Google_Service_Classroom::CLASSROOM_STUDENT_SUBMISSIONS_ME_READONLY,Google_Service_Classroom::CLASSROOM_STUDENT_SUBMISSIONS_STUDENTS_READONLY]); // Example scope, add more as needed

		// Load previously authorized credentials from a file
//		$credentialsPath = '~/.credentials/google-classroom-php-quickstart.json'; // Adjust path as needed
//		if (file_exists($credentialsPath)) {
//			$accessToken = json_decode(file_get_contents($credentialsPath), true);
//			$gClient->setAccessToken($accessToken);
//		} else {
			// Request authorization from the user
			$authUrl = $gClient->createAuthUrl();

			return $authUrl;
			header('Location: '.$authUrl); exit;
			//printf("Open the following link in your browser:\n%s\n", $authUrl);
			//print 'Enter verification code: ';
			//$authCode = trim(fgets(STDIN));

			// Exchange authorization code for an access token
			//$accessToken = $gClient->fetchAccessTokenWithAuthCode($authCode);
			//$this->setAccessToken($accessToken);

			// Save the credentials for the next run
//			if (!file_exists(dirname($credentialsPath))) {
//				mkdir(dirname($credentialsPath), 0700, true);
//			}
//			file_put_contents($credentialsPath, json_encode($accessToken));
//			printf("Credentials saved to %s\n", $credentialsPath);
		//}


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
			$url = 'https://www.googleapis.com/oauth2/v1/userinfo?access_token='.$token;
			$request = new Request('GET', $url);
			$res = $this->client->send($request);
			$this->user  = json_decode($res->getBody()->getContents());
			return $this->user;
		}catch (\Exception $e){
			throw new \Exception($e->getMessage(),$e->getCode());
		}

	}

}
