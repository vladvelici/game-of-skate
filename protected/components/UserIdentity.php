<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */

class UserIdentity extends CUserIdentity
{


    /**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
         private $_id;

	public function authenticate()
	{
                $username=strtolower($this->username);
                $search=new CDbCriteria;
                $user=User::model()->find("LOWER(user_name)=?",array($username));
		if($user===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if(!$user->validatePassword($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else {
                        $this->_id=$user->user_id;
                        $this->username=$user->user_name;
			$this->errorCode=self::ERROR_NONE;
			$user->user_last_login=time();
			//$user->user_last_ip=Yii::app()->request->getHostAdress();
			$user->save();
                }
		return !$this->errorCode;
	}
        public function getId(){
            return $this->_id;
        }
        

}
