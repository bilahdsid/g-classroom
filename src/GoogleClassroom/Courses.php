<?php

namespace GoogleClassroomEike\GoogleClassroom;

use GuzzleHttp\Psr7\Request;
class Courses extends ClientBase
{
	private $url = 'https://classroom.googleapis.com/v1/courses';
	private $headers;
	public function __construct($token)
	{
		parent::__construct();
		$this->headers = [
			'Authorization' => 'Bearer '.$token,
			'Content-Type' => 'application/json',
		];
	}

	/**
	 * @throws \Exception
	 */
	public function getList()
	{
		try{
			$request = new Request('GET', $this->url, $this->headers);
			$res = $this->client->send($request);
			return $res->getBody()->getContents();
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
			return $res->getBody()->getContents();

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
			$request = new Request('GET', $this->url.'/.'.$courseId.'/students', $this->headers);
			$res = $this->client->send($request);
			return $res->getBody()->getContents();
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
			$request = new Request('GET', $this->url.'/.'.$courseId.'/teachers', $this->headers);
			$res = $this->client->send($request);
			return $res->getBody()->getContents();
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
			$request = new Request('GET', $this->url.'/.'.$courseId.'/announcements', $this->headers);
			$res = $this->client->send($request);
			return $res->getBody()->getContents();
		}catch (\Exception $e){
			throw new \Exception($e->getMessage(),$e->getCode());
		}

	}

	/**
	 * @throws \Exception
	 */
	public function getCourseworkByCourse($courseId)
	{
		try{
			$request = new Request('GET', $this->url.'/.'.$courseId.'/courseWork', $this->headers);
			$res = $this->client->send($request);
			return $res->getBody()->getContents();
		}catch (\Exception $e){
			throw new \Exception($e->getMessage(),$e->getCode());
		}

	}

	/**
	 * @throws \Exception
	 */
	public function getClassworkStudentSubmissions($courseId, $studentId)
	{
		try{
			$request = new Request('GET', $this->url.'/.'.$courseId.'/courseWork/'.$studentId.'/studentSubmissions', $this->headers);
			$res = $this->client->send($request);
			return $res->getBody()->getContents();
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
			$request = new Request('POST', $this->url.'/.'.$courseId.'/students', $this->headers);
			$res = $this->client->send($request);
			return $res->getBody()->getContents();
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
			$request = new Request('POST', $this->url.'/.'.$courseId.'/courseWork', $this->headers);
			$res = $this->client->send($request);
			return $res->getBody()->getContents();
		}catch (\Exception $e){
			throw new \Exception($e->getMessage(),$e->getCode());
		}

	}

	/**
	 * @throws \Exception
	 */
	public function addClassworkStudentSubmissionsTurnIn($courseId, $studentId, $submission)
	{
		try{
			$request = new Request('POST', $this->url.'/.'.$courseId.'/courseWork/'.$studentId.'/studentSubmissions/'.$submission.':turnIn', $this->headers);
			$res = $this->client->send($request);
			return $res->getBody()->getContents();
		}catch (\Exception $e){
			throw new \Exception($e->getMessage(),$e->getCode());
		}

	}

	/**
	 * @throws \Exception
	 */
	public function addGradeCourseworkSubmission($courseId, $studentId, $submission)
	{
		try{
			$request = new Request('PATCH', $this->url.'/.'.$courseId.'/courseWork/'.$studentId.'/studentSubmissions/'.$submission.'?updateMask=draftGrade', $this->headers);
			$res = $this->client->send($request);
			return $res->getBody()->getContents();
		}catch (\Exception $e){
			throw new \Exception($e->getMessage(),$e->getCode());
		}

	}

}