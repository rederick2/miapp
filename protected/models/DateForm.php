<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class DateForm extends CFormModel
{
	public $id_timeline;
	public $id_asset;
	public $id_user;
	public $startDate;
	public $endDate;
	public $headline;
	public $text;
	public $tag;
	public $classname;
	//public $verifyCode;
	public $media;
	public $credit;
	public $caption;
	//campos del asset


	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('startDate, endDate, headline, text , media' , 'required'),
			// verifyCode needs to be entered correctly
			//array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}

}