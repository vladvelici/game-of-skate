<?php

class ValidatorController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
                        array('allow',
                            'actions'=>array('send', 'my'),
                            'users'=>array('@')),
                        array('allow',
                            'actions'=>array('validate','validateIt'),
                            'roles'=>array('administrator')),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionSend()
	{
		$model=new Validator;

		if(isset($_POST['Validator']))
		{
			$model->attributes=$_POST['Validator'];
                        $model->validation_file=CUploadedFile::getInstance($model,'validation_file');
			if($model->save())
				$this->redirect(array('send','msg'=>'sent'));
		}

		$this->render('send',array(
			'model'=>$model,
		));
	}

        public function actionValidate() {
		$dataProvider=new CActiveDataProvider('Validator',
                        array(
                            'criteria'=>array(
                                'condition'=>'validation_status=:s',
                                'params'=>array(':s'=>0),
                            ),
                        ));
		$this->render('validate',array(
			'dataProvider'=>$dataProvider,
		));
        }

        public function actionValidateIt($id) {
            if (isset($_GET['status']) && $_GET['status']==1) {
                $status = Validator::STATUS_VALID;
            } elseif (isset($_GET['status']) && $_GET['status']==0) {
                $status = Validator::STATUS_INVALID;
            } else {
                echo "0";
                //return false;
            }
            $model=$this->loadModel($id);
            $model->validation_status=$status;
            
            if ($model->save())
                echo "1";
            else
                echo "0";
        }
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */

        public function actionMy () {
		$dataProvider=new CActiveDataProvider('Validator',
                        array(
                            'criteria'=>array(
                                'condition'=>'validation_user=:u',
                                'params'=>array(':u'=>Yii::app()->user->id),
                                'order'=>'validation_status ASC',
                               
                            ),
                        ));
		$this->render('my',array(
			'dataProvider'=>$dataProvider,
		));
        }

	public function loadModel($id)
	{
		$model=Validator::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}
