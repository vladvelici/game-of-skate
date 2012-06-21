<?php

class GameAjaxController extends Controller
{
        protected $_model=null;
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
				'actions'=>array('status','sendTrick'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

      	public function actionSendTrick($id)
	{
                $model=$this->loadModel($id);
                if ((Yii::app()->user->id==$model->game_player1 &&
                        $model->game_current_player==1) ||
                    (Yii::app()->user->id==$model->game_player2 &&
                        $model->game_current_player==2) &&
                    $model->game_status==1)
                {
                    $coords = array();
                    foreach ($_POST as $key => $val) {
                        $coords[$key] = intval($val);
                    }
                    $trick = Trick::model()->findByTrick($coords);
                    if ($trick===null || !Validator::iCanDoThis($trick->trick_id)) {
                        if ($model->game_current_trick!=0) {
                            $model->addLetter();
                        }
                        $model->game_current_trick=0;
                        $model->game_current_position=0;
                    } else {
                        if ($model->game_current_trick==$trick->trick_id &&
                                $model->game_current_position==$coords['pos']) {

                            $model->game_current_trick=0;
                            $model->game_current_position=0;

                        } elseif ($model->game_current_trick==0) {
                            $model->game_current_trick=$trick->trick_id;
                            $model->game_current_position=$coords['pos'];
                        } else {
                            $model->game_current_trick=0;
                            $model->game_current_position=0;
                            $model->addLetter();
                        }
                    }
                    $model->toggleCurrentPlayer();

                    if ($model->save())
                        echo $model->game_status."; ;".
                         $model->game_player1_letters.";".
                         $model->game_player2_letters.";".
                         Trick::trickName($model->game_current_trick).";".
                         $model->game_current_position.";".
                         $model->game_current_player;
                    else
                        echo "false";
                } else
                    throw new CHttpException(403,"access denied");
	}

	public function actionStatus($id)
	{
            $model=$this->loadModel($id);
            if (!$model->doIPlayHere()) 
                throw new CHttpException(403,'You are not playing this game.');

            $model->updatePing();
            $model->checkPing();
            $model->save();
            
            $response=$model->game_status.";";
            if (Yii::app()->user->id==$model->game_player1 && $model->game_player2!=0)
                $response.=User::getName($model->game_player2).";";
            elseif (Yii::app()->user->id==$model->game_player2 && $model->game_player1!=0)
                $response.=User::getName($model->game_player1).";";
            else
                $response.="0;";
            $response.=$model->game_player1_letters.";".$model->game_player2_letters.";";
            if ($model->game_current_trick)
                $response.=Trick::trickName($model->game_current_trick).";".$model->game_current_position.";";
            else
                $response.="0;0;";
            $response.=$model->game_current_player;
            echo $response;
	}
        /**
         *
         * @param integer $id
         * @return object Game
         */
        protected function loadModel($id) {
            if ($this->_model===null)
                $this->_model=Game::model()->findByPk((int)$id);

            if ($this->_model===null)
            	throw new CHttpException(404,'The requested page does not exist.');

            return $this->_model;
        }

}