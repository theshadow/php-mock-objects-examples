<?php

namespace MyWedding;

use MyWedding\User;

/**
 * Requirement a Model which represets a User which has an accessor methods for an ID and Password
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
}