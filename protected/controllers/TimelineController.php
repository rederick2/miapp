<?php

class TimelineController extends Controller
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

        //$app->language = 'fr';
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
	public function actionCreateDate()
	{
		$model=new DateForm;
		if(isset($_POST['DateForm']))
		{
			$model->attributes=$_POST['DateForm'];
			if($model->validate())
			{

					$asset 		=	new Asset();
					$asset->media = $model->attributes['media'];
					$asset->credit = $model->attributes['credit'];
					$asset->caption = $model->attributes['caption'];

					if($asset->save()){
						$idAsset = $asset->primaryKey;

						$idUser = Yii::app()->user->getId();
						$idTimeline = 1;

						$date = new TimelineDate();
						$date->id_timeline = $idTimeline;
						$date->id_asset = $idAsset;
						$date->id_user = $idUser;
						$date->startDate = $model->attributes['startDate'];
						$date->endDate = $model->attributes['endDate'];
						$date->headline = $model->attributes['headline'];
						$date->text = $model->attributes['text'] . ' <a href="'.Yii::app()->baseUrl.'/'.Yii::app()->user->name.'">by '.Yii::app()->user->name.'</a>';
						$date->tag = $model->attributes['tag'];

						if($date->save()){
							Yii::app()->user->setFlash('create','Se guardó correctamente');
							$this->refresh();
						}else{
							Yii::app()->user->setFlash('create','No Se guardó correctamente');
							$this->refresh();
						}

					}else{
						Yii::app()->user->setFlash('create','No Se guardó correctamente');
						$this->refresh();
					}
				
			}
		}

		//print_r($model);
		/*$username	=	Yii::app()->user->name;
   		$user 		=	User::model()->find('LOWER(username)=?',array($username));*/

		$this->render('create_date',array('model'=>$model));
	}


	public function actionCreateAsset()
	{
		$model=new AssetForm;
		if(isset($_POST['AssetForm']))
		{
			$model->attributes=$_POST['AssetForm'];
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

					Yii::app()->user->setFlash('create','Se guardó correctamente');
					$this->refresh();

				
			}
		}

		//print_r($model);
		/*$username	=	Yii::app()->user->name;
   		$user 		=	User::model()->find('LOWER(username)=?',array($username));*/

		$this->render('timeline/create_asset',array('model'=>$model));
	}

	public function actionJsonTimeline(){

		$timeline = Timeline::model()->with('asset')->find('id_timeline=?', array(1));

		$dates=TimelineDate::model()->with('asset')->findAll();

		$arr = CJSON::encode(TimelineDate::convertModelToArray($dates));

		echo '{
			"timeline": {
				"headline":"'.$timeline->headline.'",
				"text":"'.$timeline->text.'",
				"type":"'.$timeline->type.'",
				"asset":
					{
						"media":"'.$timeline->asset->media.'",
						"credit":"'.$timeline->asset->credit.'",
						"caption":"'.$timeline->asset->caption.'"
					},
				"date" : '.$arr.'
			}
		}';

		

	}

	

	
}