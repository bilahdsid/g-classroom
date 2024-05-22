<?php

namespace GoogleClassroomEike\GoogleClassroom;

use Google\Service\Classroom;
use GuzzleHttp\Psr7\Request;
class Courses extends ClientBase
{
	private $url = 'https://classroom.googleapis.com/v1/courses';
	private $headers;
	public function __construct($token,Auth $auth)
	{
		parent::__construct();
		$auth->gClient->refreshToken($token);
		$this->headers = [
			'Authorization' => 'Bearer '.$token,
			'Content-Type' => 'application/json',
		];
	}

	/**
	 * @throws \Exception
	 */
	public function getList($teacherId = 'me')
	{
		try{
			$url = $this->url.'?courseStates=ACTIVE';
			if($teacherId != null){
				$url = $url.'&teacherId='.$teacherId;
			}
			$request = new Request('GET', $url, $this->headers);
			$res = $this->client->send($request);
			return $this->transformResponse($res->getBody()->getContents());
		}catch (\Exception $e){
			throw new \Exception($e->getMessage(),$e->getCode());
		}
	}

	/**
	 * @throws \Exception
	 */
	public function create($body)
	{
		try{
			$request = new Request('POST', $this->url, $this->headers, $body);
			$res = $this->client->send($request);
			return $this->transformResponse($res->getBody()->getContents());

		}catch (\Exception $e){
			throw new \Exception($e->getMessage(),$e->getCode());
		}
	}

	/**
	 * @throws \Exception
	 */
	public function getStudentsByCourse($courseId)
	{
		try{
			$request = new Request('GET', $this->url.'/'.$courseId.'/students', $this->headers);
			$res = $this->client->send($request);
			return $this->transformResponse($res->getBody()->getContents());
		}catch (\Exception $e){
			throw new \Exception($e->getMessage(),$e->getCode());
		}

	}

	/**
	 * @throws \Exception
	 */
	public function getTeachersByCourse($courseId)
	{
		try{
			$request = new Request('GET', $this->url.'/'.$courseId.'/teachers', $this->headers);
			$res = $this->client->send($request);
			return $this->transformResponse($res->getBody()->getContents());
		}catch (\Exception $e){
			throw new \Exception($e->getMessage(),$e->getCode());
		}

	}

	/**
	 * @throws \Exception
	 */
	public function getAnnouncementsByCourse($courseId)
	{
		try{
			$request = new Request('GET', $this->url.'/'.$courseId.'/announcements', $this->headers);
			$res = $this->client->send($request);
			return $this->transformResponse($res->getBody()->getContents());
		}catch (\Exception $e){
			throw new \Exception($e->getMessage(),$e->getCode());
		}

	}

	/**
	 * @throws \Exception
	 */
	public function getCourseworkByCourse($courseId,$courseWorkId)
	{
		try{
			$request = new Request('GET', $this->url.'/'.$courseId.'/courseWork/'.$courseWorkId, $this->headers);
			$res = $this->client->send($request);
			return $this->transformResponse($res->getBody()->getContents());
		}catch (\Exception $e){
			throw new \Exception($e->getMessage(),$e->getCode());
		}
	}

	/**
	 * @throws \Exception
	 */
	public function getClassworkStudentSubmissions($courseId, $courseWorkId, $userId = null)
	{
		try{
			$url = $this->url.'/'.$courseId.'/courseWork/'.$courseWorkId.'/studentSubmissions';
			if($userId != null){
				$url = $url.'?userId='.$userId;
			}
			$request = new Request('GET',$url , $this->headers);
			$res = $this->client->send($request);
			return $this->transformResponse($res->getBody()->getContents());
		}catch (\Exception $e){
			throw new \Exception($e->getMessage(),$e->getCode());
		}

	}

	/**
	 * @throws \Exception
	 */
	public function addStudent($body, $courseId)
	{
		try{
			$request = new Request('POST', $this->url.'/'.$courseId.'/students', $this->headers,$body);
			$res = $this->client->send($request);
			return $this->transformResponse($res->getBody()->getContents());
		}catch (\Exception $e){
			throw new \Exception($e->getMessage(),$e->getCode());
		}

	}

	/**
	 * @throws \Exception
	 */
	public function addCoursework($body, $courseId)
	{
		try{
			$request = new Request('POST', $this->url.'/'.$courseId.'/courseWork', $this->headers,$body);
			$res = $this->client->send($request);
			return $this->transformResponse($res->getBody()->getContents());
		}catch (\Exception $e){
			throw new \Exception($e->getMessage(),$e->getCode());
		}

	}

	/**
	 * @throws \Exception
	 */
	public function addClassworkStudentSubmissionsTurnIn($courseId, $courseWorkId, $submission,$body)
	{
		try{
			$request = new Request('POST', $this->url.'/'.$courseId.'/courseWork/'.$courseWorkId.'/studentSubmissions/'.$submission.':turnIn', $this->headers,$body);
			$res = $this->client->send($request);
			return $this->transformResponse($res->getBody()->getContents());
		}catch (\Exception $e){
			throw new \Exception($e->getMessage(),$e->getCode());
		}

	}

	/**
	 * @throws \Exception
	 */
	public function addGradeCourseworkSubmission($courseId, $courseWorkId, $submission,$body)
	{
		try{
			$request = new Request('PATCH', $this->url.'/'.$courseId.'/courseWork/'.$courseWorkId.'/studentSubmissions/'.$submission.'?updateMask=draftGrade,assignedGrade', $this->headers,$body);
			$res = $this->client->send($request);
			return $this->transformResponse($res->getBody()->getContents());
		}catch (\Exception $e){
			throw new \Exception($e->getMessage(),$e->getCode());
		}

	}

}