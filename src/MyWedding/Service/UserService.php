<?php

namespace MyWedding\Service;

class UserService 
{
    protected $db;

    public function setDb(\PDO $db) 
    {
        $this->db = $db;
        return $this;
    }

    public function getDb()
    {
        if (is_null($this->db)) 
        {
            throw new \LogicException('Database adapter must be defined.');
        }
        return $this->db;
    }

    public function fetchByEmailAndPassword($email, $password)
    {
        $statement = $this->getDb()->prepare('
            SELECT 
                user_id,
                email
            FROM 
                user
            WHERE 
                email = :email
            AND
                password = :password
        ');

        $resultHandle = $statement->execute(
            array(
                ':email'    => $email,
                ':password' => $password,
            )
        );

        if (!$resultHandle)
        {
            throw new \LogicException('Query Failed');
        }

        $result = $statement->fetch(\PDO::FETCH_ASSOC);
        $resultHandle->closeCursor();

        if (empty($result)) 
        {
            return null; 
        }

        $user = new User();
        $user->setId($result['user_id'])
            ->setEmail($result['email']);

        return $user;
    }
}