<?php

/**
 * This is the model class for table "validation".
 *
 * The followings are the available columns in table 'validation':
 * @property integer $validation_id
 * @property integer $validation_user
 * @property integer $validation_status
 * @property integer $validation_trick
 * @property string $validation_file
 */
class Validator extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Validator the static model class
	 */

         const STATUS_PENDING=0;
         const STATUS_VALID=1;
         const STATUS_INVALID=2;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'validation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('validation_trick', 'required'),
			array('validation_trick', 'numerical', 'integerOnly'=>true),
                        array('validation_status','in','range'=>array(0,1,2)),
			//array('validation_file', 'file', 'types'=>'mpeg, mpg, mp4, avi, 3gp'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('validation_user, validation_status, validation_trick', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'trick'=>array(self::BELONGS_TO, 'Trick', 'validation_trick'),
                    'user'=>array(self::BELONGS_TO, 'User', 'validation_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'validation_id' => 'Validation ID',
			'validation_user' => 'User',
			'validation_status' => 'Status',
			'validation_trick' => 'Trick ID',
			'validation_file' => 'Video file',
		);
	}

        public function iCanDoThis($trickId) {
            if (HORSE_ALLOW_ANY_TRICK===true)
                return true;
            $search = new CDbCriteria;
            $search->addCondition("validation_trick=:t");
            $search->addCondition("validation_user=:u");
            $search->addCondition("validation_status=:s");
            $search->params=array(
                ":t"=>$trickId,
                ":u"=>Yii::app()->user->id,
                ":s"=>Validator::STATUS_VALID,
            );
            if (Validator::model()->find($search)===null)
                return false;
            return true;
        }


	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('validation_user',$this->validation_user);
		$criteria->compare('validation_status',$this->validation_status);
		$criteria->compare('validation_trick',$this->validation_trick);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

        protected function beforeSave() {
            if ($this->isNewRecord) {
                $this->validation_user=Yii::app()->user->id;

                $search = new CDbCriteria;
                $search->select="validation_id";
                $search->addCondition("validation_user=:user");
                $search->addCondition("validation_status=:status");
                $search->addCondition("validation_trick=:trick");
                $search->params=array(":user"=>$this->validation_user,
                                      ":status"=>Validator::STATUS_VALID,
                                      ":trick"=>$this->validation_trick,
                                     );
                if (Validator::model()->find($search)!==null) 
                    return false;
                

                $this->validation_status=Validator::STATUS_PENDING;
                $flvTool = new FLVtool;
                $flvTool->source = $this->validation_file->getTempName();
                var_dump($flvTool->source);
                $flvTool->dest="/var/www/video/validator";
                $fileName=$flvTool->saveFLV();
                if ($fileName!==false) {
                    $this->validation_file=$fileName;
                    return true;
                } else
                    return false;
            }
            return true;
        }
}