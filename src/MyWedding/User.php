<?php 

namespace MyWedding;

class User
{
    protected $id;

    protected $email;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        if (!is_integer($id)) 
        { 
            throw new \InvalidArgumentException('ID must be an integer value.');
        }

        $this->id = $id;

        return $this;
    }

    public function getEmail()
    {
    	return $this->email;
    }

    public function setEmail($email)
    {
    	if (!is_string($email)) 
    	{
            throw new \InvalidArgumentException('Email must be a string value.');
    	}
    	elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
    		throw new \InvalidArgumentException('Email must be a valid e-mail address');
    	}

    	$this->email = $email;

    	return $this;
    }
}