<?php

/**
 * This is the model class for table "tutorials".
 *
 * The followings are the available columns in table 'tutorials':
 * @property integer $tutorial_id
 * @property integer $tutorial_trick
 * @property string $tutorial_file
 * @property string $tutorial_text
 * @property string $tutorial_cache
 */
class Tutorial extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Tutorial the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tutorials';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tutorial_trick, tutorial_text', 'required'),
			array('tutorial_trick', 'numerical', 'integerOnly'=>true),
			array('tutorial_file','file','types'=>'mpg, mpeg, mp4, avi, flv, 3gp, mov'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('tutorial_trick, tutorial_text', 'safe', 'on'=>'search'),
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
                    'trick'=>array(self::BELONGS_TO,'Trick','tutorial_trick'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'tutorial_id' => 'Tutorial',
			'tutorial_trick' => 'Trick',
			'tutorial_file' => 'Video file',
			'tutorial_text' => 'Text',
			'tutorial_cache' => 'Cache img',
		);
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

		$criteria->compare('tutorial_id',$this->tutorial_id);
		$criteria->compare('tutorial_trick',$this->tutorial_trick);
		$criteria->compare('tutorial_text',$this->tutorial_text,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
        protected function beforeSave() {
            if (is_object($this->tutorial_file)) {
                $flvTool = new FLVtool;
                $flvTool->source = $this->tutorial_file->getTempName();
                $flvTool->dest="/var/www/horse/video/tutorial";
                $fileName=$flvTool->saveFLV();
                if ($fileName!==false) {
                    $this->tutorial_file=$fileName;
                    return true;
                } else
                    return false;
            }
            return true;
        }
}