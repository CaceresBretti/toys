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
	public function authenticate()
	{
		/*
		$users=array(
			'demo'=>'demo',
			'admin'=>'admin',
		);
		*/

		$atts = array(
			'name' => $this->username, //traspasa el "nombre" mandado por formulario (models / LoginForm.php)
		);

		$usuario = Users::model()->findByAttributes($atts); //busca este nombre en la bdd usando el USER.PHP creado con el CRUD que esta en la carpeta Model

		if(($usuario===null))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($usuario->password!==sha1($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;

		/*
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
		*/
	}
}
