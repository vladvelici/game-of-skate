<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $user_id
 * @property string $user_name
 * @property string $user_password
 * @property string $user_salt
 * @property string $user_email
 * @property string $user_points
 * @property integer $user_joined
 * @property integer $user_last_login
 * @property string $user_last_ip
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
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
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_name, user_password, user_email', 'required'),
			array('user_name', 'length', 'max'=>50),
			array('user_email', 'length', 'max'=>254),
                        array('user_email', 'email'),
                        array('user_name, user_email', 'unique'),
                        array('user_name','match','pattern'=>'/^[0-9a-zA-Z_]+$/'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, user_name, user_email, user_points, user_joined, user_last_login, user_last_ip', 'safe', 'on'=>'search'),
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
			'tricks'=>array(self::HAS_MANY,"Validator","validation_user"),
			'games'=>array(self::HAS_MANY,"Game","game_player1, game_player2"),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'user_name' => 'Username',
			'user_password' => 'Password',
			'user_email' => 'E-mail adress',
			'user_points' => 'Points',
			'user_joined' => 'Joined',
			'user_last_login' => 'Last visit',
			'user_last_ip' => 'Last IP',
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('user_email',$this->user_email,true);
		$criteria->compare('user_joined',$this->user_joined);
		$criteria->compare('user_last_ip',$this->user_last_ip,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
        public function hashPassword($password) {
            return hash("sha256",$this->user_salt.$password);
        }
        public function validatePassword($password) {
            $password=$this->hashPassword($password);
            return $this->user_password === $password;
        }
	public function updatePoints($points) {
		$this->user_points+=$points;
		$this->save();
	}
        protected function beforeSave() {
            if ($this->isNewRecord) {
                $this->user_salt=Helper::randomString(10);
                $this->user_password=$this->hashPassword($this->user_password);
                $this->user_joined=time();
                $this->user_points=0;
            }// else
            //$this->user_last_ip=CHttpRequest::getUserHostAdress();
            return true;
        }

        protected function afterSave() {
            //mail activation...
            return true;
        }
        public function getName($id) {
            if (Yii::app()->user->id===$id) return Yii::app()->user->name;
            $search = new CDbCriteria;
            $search->select="user_name";
            $model = User::model()->findByPk((int)$id,$search);
            if ($model===null)
                return false;
            return $model->user_name;
        }

}
