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
	 * @throws \HttpException
	 */
	public function getList()
	{
		try{
			$request = new Request('GET', $this->url, $this->headers);
			$res = $this->client->send($request);
			return $res->getBody()->getContents();
		}catch (\Exception $e){
			throw new \HttpException($e->getMessage(),$e->getCode());
		}

	}

	/**
	 * @throws \HttpException
	 */
	public function create($body)
	{
		try{
			$request = new Request('POST', $this->url, $this->headers, $body);
			$res = $this->client->send($request);
			return $res->getBody()->getContents();

		}catch (\Exception $e){
			throw new \HttpException($e->getMessage(),$e->getCode());
		}
	}

	/**
	 * @throws \HttpException
	 */
	public function getStudentsByCourse($courseId)
	{
		try{
			$request = new Request('GET', $this->url.'/.'.$courseId.'/students', $this->headers);
			$res = $this->client->send($request);
			return $res->getBody()->getContents();
		}catch (\Exception $e){
			throw new \HttpException($e->getMessage(),$e->getCode());
		}

	}

	/**
	 * @throws \HttpException
	 */
	public function getTeachersByCourse($courseId)
	{
		try{
			$request = new Request('GET', $this->url.'/.'.$courseId.'/teachers', $this->headers);
			$res = $this->client->send($request);
			return $res->getBody()->getContents();
		}catch (\Exception $e){
			throw new \HttpException($e->getMessage(),$e->getCode());
		}

	}

	/**
	 * @throws \HttpException
	 */
	public function getAnnouncementsByCourse($courseId)
	{
		try{
			$request = new Request('GET', $this->url.'/.'.$courseId.'/announcements', $this->headers);
			$res = $this->client->send($request);
			return $res->getBody()->getContents();
		}catch (\Exception $e){
			throw new \HttpException($e->getMessage(),$e->getCode());
		}

	}

	/**
	 * @throws \HttpException
	 */
	public function getCourseworkByCourse($courseId)
	{
		try{
			$request = new Request('GET', $this->url.'/.'.$courseId.'/courseWork', $this->headers);
			$res = $this->client->send($request);
			return $res->getBody()->getContents();
		}catch (\Exception $e){
			throw new \HttpException($e->getMessage(),$e->getCode());
		}

	}

	/**
	 * @throws \HttpException
	 */
	public function getClassworkStudentSubmissions($courseId, $studentId)
	{
		try{
			$request = new Request('GET', $this->url.'/.'.$courseId.'/courseWork/'.$studentId.'/studentSubmissions', $this->headers);
			$res = $this->client->send($request);
			return $res->getBody()->getContents();
		}catch (\Exception $e){
			throw new \HttpException($e->getMessage(),$e->getCode());
		}

	}

	/**
	 * @throws \HttpException
	 */
	public function addStudent($body, $courseId)
	{
		try{
			$request = new Request('POST', $this->url.'/.'.$courseId.'/students', $this->headers);
			$res = $this->client->send($request);
			return $res->getBody()->getContents();
		}catch (\Exception $e){
			throw new \HttpException($e->getMessage(),$e->getCode());
		}

	}

	/**
	 * @throws \HttpException
	 */
	public function addCoursework($body, $courseId)
	{
		try{
			$request = new Request('POST', $this->url.'/.'.$courseId.'/courseWork', $this->headers);
			$res = $this->client->send($request);
			return $res->getBody()->getContents();
		}catch (\Exception $e){
			throw new \HttpException($e->getMessage(),$e->getCode());
		}

	}

	/**
	 * @throws \HttpException
	 */
	public function addClassworkStudentSubmissionsTurnIn($courseId, $studentId, $submission)
	{
		try{
			$request = new Request('POST', $this->url.'/.'.$courseId.'/courseWork/'.$studentId.'/studentSubmissions/'.$submission.':turnIn', $this->headers);
			$res = $this->client->send($request);
			return $res->getBody()->getContents();
		}catch (\Exception $e){
			throw new \HttpException($e->getMessage(),$e->getCode());
		}

	}

	/**
	 * @throws \HttpException
	 */
	public function addGradeCourseworkSubmission($courseId, $studentId, $submission)
	{
		try{
			$request = new Request('PATCH', $this->url.'/.'.$courseId.'/courseWork/'.$studentId.'/studentSubmissions/'.$submission.'?updateMask=draftGrade', $this->headers);
			$res = $this->client->send($request);
			return $res->getBody()->getContents();
		}catch (\Exception $e){
			throw new \HttpException($e->getMessage(),$e->getCode());
		}

	}

}