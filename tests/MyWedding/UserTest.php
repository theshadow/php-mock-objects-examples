<?php

namespace MyWedding;

use MyWedding\User;

/**
 * Requirement a Model which represets a User which has an accessor methods for an ID and E-mail
 * 
 * ID: integer
 * E-mail: string and valid e-mail format.
 */
class UserTest extends \PHPUnit_Framework_TestCase
{
	protected $model;

	public function setUp()
	{
		$this->model = new User();
	}

	public function testThatGetIdDefaultsToNull()
	{
		$this->assertNull($this->model->getId());
	}

	public function testThatSetIdReturnsSelf()
	{
		$id    = mt_rand(); 
		$model = $this->model->setId($id);
		$this->assertSame($this->model, $model);

		return array($id, $model);
	}

	/**
	 * @depends testThatSetIdReturnsSelf
	 */
	public function testThatGetIdReturnsSetValue(array $params)
	{
		list($id, $model) = $params;

		$this->assertEquals($id, $model->getId());
	}

	/**
	 *
	 *
	 * @expectedException \InvalidArgumentException
	 */
	public function testThatSetIdThrowsInvalidArgExceptionWhenIdIsNotInt()
	{
		$id = uniqid();
		
		$this->model->setId($id);	
	}
}