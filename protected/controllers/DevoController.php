<?php

class DevoController extends Controller
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

	function actionDevobyid(){
		$id = $_POST['id'];
		$devo = Devos::model()->with('user')->find('id_devo=?', array($id));

		$comments = Comment::model()->with('user')->findAll('id_of_type = ?' , array($id));
		//echo $devo->text;
		$picture = $devo->user->picture == '' ? Yii::app()->baseUrl.'/uploads/user.png' : $devo->user->picture;
		$result = array('text' => $devo->text, 
						'iduser' => $devo->user->id,
						'username' => $devo->user->username , 
						'picture' => $picture,
						'first_name' => $devo->user->first_name,
						'last_name' => $devo->user->last_name,
						'comments' => TimelineDate::convertModelToArray($comments));

		echo '['.json_encode($result).']';
	}

	function actionComment(){
		$id_user = $_POST['id_user'];
		$id = $_POST['id'];
		$text = $_POST['text'];

		$model = new Comment;
		$model->id_user = $id_user;
		$model->id_of_type = $id;
		$model->type = 'Devos';
		$model->text = $text;
		$model->create_time = date('Y-m-d G:i:s');

		if($model->save()){

			$user = User::model()->find('id = ?', array($id_user));

			$picture = $user->picture == '' ? Yii::app()->baseUrl.'/uploads/user.png' : $user->picture;

			$result = array( 'success' => 'true', 'text' => $text, 
						'username' => $user->username , 
						'picture' => $picture,
						'first_name' => $user->first_name,
						'last_name' => $user->last_name);

		}else{

			$result = array( 'success' => 'false', 'text' => 'No se pudo enviar el comentario');

		}

		//$picture = $devo->user->picture == '' ? Yii::app()->baseUrl.'/uploads/user.png' : $devo->user->picture;
		

		echo '['.json_encode($result).']';
	}

}