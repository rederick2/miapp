<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	function init()
    {
        parent::init();
        $app = Yii::app();
        if (isset($_POST['_lang']))
        {
            $app->language = $_POST['_lang'];
            $app->session['_lang'] = $app->language;
        }
        else if (isset($app->session['_lang']))
        {
            $app->language = $app->session['_lang'];
        }

        $app->language = 'es';
    }

	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$result = array(
		    array("id"=>1, "firstName"=>"Mark", "lastName"=>"Otto", "language"=>"CSS"),
		    array("id"=>2, "firstName"=>"Jacob", "lastName"=>"Thornton", "language"=>"JavaScript"),
		    array("id"=>3, "firstName"=>"Stu", "lastName"=>"Dent", "language"=>"HTML")
		);

		$model=new LoginForm;

		//print_r($result);

		$gridDataProvider = new CArrayDataProvider($result);

		$params =array(
           'gridDataProvider'=>$gridDataProvider,
           'model' => $model
       	);

		if(Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('index' , $params, false, true);
		}else{
			$this->render('index' , $params);
		}
		
	}

	public function actionTimeline()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->layout = false;

		$this->render('timeline');
	}

	public function actionView()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		//$this->render('index' , $params);
		echo $_GET['id'];
	}

	public function actionUser()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$result = array(
		    array("id"=>1, "firstName"=>$_GET['user'], "lastName"=>"Otto", "language"=>"CSS"),
		    array("id"=>2, "firstName"=>"Jacob", "lastName"=>"Thornton", "language"=>"JavaScript"),
		    array("id"=>3, "firstName"=>"Stu", "lastName"=>"Dent", "language"=>"HTML")
		);

		$model=new LoginForm;

		//print_r($result);

		$gridDataProvider = new CArrayDataProvider($result);

		$params =array(
           'gridDataProvider'=>$gridDataProvider,
           'model' => $model
       	);

       	if(Yii::app()->request->isAjaxRequest) {
       		$this->renderPartial('index' , $params , false, true);
       	}else{
       		$this->render('index' , $params);
       	}
		
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}

		//print_r($model);
		if(Yii::app()->request->isAjaxRequest) { 
			$this->renderPartial('contact',array('model'=>$model) , false, true);
		} else { 
			$this->render('contact',array('model'=>$model)); 
		}

		//$this->renderPartial('contact',array('model'=>$model) , false, true);
	}

	/**
	 * Displays the contact page
	 */
	public function actionEditProfile()
	{
		$model=new UserForm;
		if(isset($_POST['UserForm']))
		{
			$model->attributes=$_POST['UserForm'];
			if($model->validate())
			{

				$username	=	Yii::app()->user->name;
   				$user 		=	User::model()->find('LOWER(username)=?',array($username));

				$user->first_name = $model->attributes['first_name'];
				$user->last_name = $model->attributes['last_name'];
				$user->e_mail = $model->attributes['e_mail'];
				$user->username = $model->attributes['username'];
				$user->password = $model->attributes['password'];

				$user->save();

				Yii::app()->user->setFlash('contact','Se guardó correctamente');
				$this->refresh();
				//print_r();
			}
		}

		//print_r($model);
		$username	=	Yii::app()->user->name;
   		$user 		=	User::model()->find('LOWER(username)=?',array($username));

		$this->render('profile/editar',array('model'=>$model , 'user' => $user));
	}

	public function actionRegisterProfile()
	{
		$model=new UserForm;
		if(isset($_POST['UserForm']))
		{
			$model->attributes=$_POST['UserForm'];
			if($model->validate())
			{

	

					$user 		=	new User();
					$user->first_name = $model->attributes['first_name'];
					$user->last_name = $model->attributes['last_name'];
					$user->e_mail = $model->attributes['e_mail'];
					$user->username = $model->attributes['username'];
					$user->password = md5($model->attributes['password']);
					$user->picture = $model->attributes['picture'];

					$user->insert();

					Yii::app()->user->setFlash('register','Se guardó correctamente');
					$this->refresh();

				
			}
		}

		//print_r($model);
		/*$username	=	Yii::app()->user->name;
   		$user 		=	User::model()->find('LOWER(username)=?',array($username));*/

		$this->render('profile/register',array('model'=>$model));
	}

	public function actionUpload(){
	    $file = CUploadedFile::getInstanceByName('file');
	    // Do your business ... save on file system for example,
	    // and/or do some db operations for example
	    $file->saveAs('uploads/'.$file->getName());
	    // return the new file path
	    echo Yii::app()->baseUrl.'/uploads/'.$file->getName();
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		if(Yii::app()->request->isAjaxRequest) { 
			$this->renderPartial('login',array('model'=>$model) , false, true);
		} else { 
			$this->render('login',array('model'=>$model));
		}
		
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}