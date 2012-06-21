<?php

class GameController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}


	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('play','index'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
				'roles'=>array('administrator'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionPlay($id)
	{
                $model = $this->loadModel($id);

               if (!$model->doIPlayHere())
                    throw new CHttpException(403,"You are/were not playing in this game.");

		$this->render('play',array(
			'model'=>$model,
		));
	}

        /**
	 * Lists all models.
	 */
	public function actionIndex()
	{
            //check if user plays a game already
            $search = new CDbCriteria();
            $search->select = "game_id";
            $search->addCondition("(game_player1=".Yii::app()->user->id." OR
                                game_player2=".Yii::app()->user->id.") AND
                                (game_status=".Game::STATUS_PLAYING." OR
                                 game_status=".Game::STATUS_PENDING.")");
            $check = Game::model()->find($search);
            if ($check!==null)
                $this->redirect(array('game/play','id'=>$check->game_id));

            //search for an empty opened slot
            $search = new CDbCriteria();
            $search->addCondition('game_player1!=0');
            $search->addCondition('game_player2=0');
            $search->addCondition('game_status=0');
            $model = Game::model()->find($search);
            if ($model===null) {
                $model = new Game;
                if ($model->save())
                        $this->redirect(array('game/play','id'=>$model->game_id));
            } else {
                if ($model->game_player1==0) {
                    $model->game_player1=Yii::app()->user->id;
                    $model->game_player1_ping=time();
                } else {
                    $model->game_player2=Yii::app()->user->id;
                    $model->game_player2_ping=time();
                }
                $model->game_current_player=mt_rand(1,2);
                $model->game_status=1;
                if ($model->save())
                        $this->redirect(array('game/play','id'=>$model->game_id));
            }
	}

        /**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Game('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Game']))
			$model->attributes=$_GET['Game'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Game::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='game-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
