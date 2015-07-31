<?php

class AdminIdentity extends CUserIdentity
{
    private $_id;

    /**
     * Authenticates a user.
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        $credentials = [
            'admin' => [
                'id' => 1,
                'password' => '123454321',
            ],
        ];


        if(!isset($credentials[$this->username]))
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if($credentials[$this->username]['password'] !== $this->password)
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->_id = $credentials[$this->username]['id'];
            $this->setState('role', AuthHelper::ROLE_ADMIN);
            $this->errorCode=self::ERROR_NONE;
        }
        return $this->errorCode==self::ERROR_NONE;
    }

    /**
     * @return integer the ID of the user record
     */
    public function getId()
    {
        return $this->_id;
    }
}