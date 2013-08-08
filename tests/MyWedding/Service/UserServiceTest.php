<?php

namespace MyWedding;

use MyWedding\Service\UserService;
use MyWedding\User;

/**
 * 
 */
class UserServiceTest extends \PHPUnit_Framework_TestCase
{
	protected $service;

	public function setUp()
	{
		$this->service = new UserService();
	}

	public function testThatGetIdDefaultsToNull()
	{
		$email    = uniqid() . '@example.com';
		$password = uniqid();

		$results = array(
			'user_id' => mt_rand(),
			'email'   => $email,
		);

		$expectedUser = new User();
		$expectedUser->setId($results['user_id']);
		$expectedUser->setEmail($results['email']);

		$statement = $this->getMock(
			'\PDOStatement', 
			array(
				'execute', 
				'statement', 
				'closeCursor',
				'__wakeup',
				'__sleep',
			), 
			array(), 
			'', 
			false
		);
		$statenent->expects($this->once())
			->method('execute')
			->with(
				$this->equalTo(
					array(
		                ':email'    => $email,
		                ':password' => $password,
		            )
            	)
			)
			->will($this->returnValue(true));
		$statement->expects($this->once())
			->method('fetch')
			->with(
				$this->equalTo(\PDO::FETCH_ASSOC)
			)
			->will($this->returnValue($results));
		$statement->expects($this->once())
			->method('closeCursor');


		$query = '
            SELECT 
                user_id,
                email
            FROM 
                user
            WHERE 
                email = :email
            AND
                password = :password
        ';

		$db = $this->getMock('\PDO', array('prepare'), array(), '', false);
		$db->expects($this->once())
			->method('prepare')
			->with(
				$this->equalTo(
					$query
				)
			)
			->will($this->returnValue($statement));

		$actualUser = $this->service->setDb($db)
			->fetchByEmailAndPassword($email, $password);

		$this->assertEquals($expectedUser->getId(), $actualUser->getId());
		$this->assertEquals($expectedUser->getEmail(), $actualUser->getEmail());
	}
}
















