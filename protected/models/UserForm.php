<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class UserForm extends CFormModel
{
	public $username;
	public $e_mail;
	public $first_name;
	public $last_name;
	public $password;
	public $picture;
	public $password_repeat;
	//public $verifyCode;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('username, e_mail, first_name, last_name, password, password_repeat' , 'required'),
			// email has to be a valid email address
			array('e_mail', 'email'),

			array('username', 'unique', 'attributeName' => 'username', 'className' => 'User'),

			array('e_mail', 'unique', 'attributeName' => 'e_mail', 'className' => 'User'),
        	
        	array('password', 'compare', 'compareAttribute'=>'password_repeat'),
			// verifyCode needs to be entered correctly
			//array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	/*public function attributeLabels()
	{
		return array(
			'verifyCode'=>'Verification Code',
		);
	}*/
}