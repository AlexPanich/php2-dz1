<?php

namespace App\Models;


use App\Model;

class User extends Model
{
    const TABLE = 'users';

    protected $email;
    protected $name;

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return User ;
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return User ;
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }


}