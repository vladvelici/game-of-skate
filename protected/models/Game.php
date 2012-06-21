<?php

/**
 * This is the model class for table "games".
 *
 * The followings are the available columns in table 'games':
 * @property integer $game_id
 * @property integer $game_status
 * @property integer $game_current_player
 * @property integer $game_current_trick
 * @property integer $game_current_position
 * @property integer $game_player1
 * @property integer $game_player2
 * @property string $game_player1_ping
 * @property string $game_player2_ping
 * @property integer $game_player1_letters
 * @property integer $game_player2_letters
 */
class Game extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Game the static model class
	 */
         const MAX_PING=20;
         const STATUS_PENDING=0;
         const STATUS_PLAYING=1;
         const STATUS_P1_WON=2;
         const STATUS_P2_WON=3;
         const STATUS_DISCONNECTED=4;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'games';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('game_id, game_status, game_player1, game_player2, game_player1_ping, game_player2_ping', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'game_id' => 'Game',
			'game_status' => 'Game Status',
			'game_current_player' => 'Game Current Player',
			'game_current_trick' => 'Game Current Trick',
			'game_player1' => 'Game Player1',
			'game_player2' => 'Game Player2',
			'game_player1_ping' => 'Game Player1 Ping',
			'game_player2_ping' => 'Game Player2 Ping',
                    	'game_player1_letters' => 'Player1 Letters',
			'game_player2_letters' => 'Player2 Letters',
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

		$criteria->compare('game_id',$this->game_id);
		$criteria->compare('game_status',$this->game_status);
		$criteria->compare('game_player1',$this->game_player1);
		$criteria->compare('game_player2',$this->game_player2);
		$criteria->compare('game_player1_ping',$this->game_player1_ping,true);
		$criteria->compare('game_player2_ping',$this->game_player2_ping,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
        protected function beforeSave() {
            if ($this->isNewRecord) {
                $this->game_player1 = Yii::app()->user->id;
                $this->game_player2 = 0;
                $this->game_status=Game::STATUS_PENDING;
                $this->game_player1_ping=time();
                $this->game_player2_ping=0;
                $this->game_player1_letters=0;
                $this->game_player2_letters=0;
            } else {
		if ($this->game_status==Game::STATUS_P1_WON) {
			User::model()->findByPk($this->game_player1)->updatePoints(6-$this->game_player1_letters);
		} elseif ($this->game_status==Game::STATUS_P2_WON) {
			User::model()->findByPk($this->game_player2)->updatePoints(6-$this->game_player2_letters);
		}
	    }
            return true;
        }
        /**
         * Actualizeaza ping-ul jucatorilor
         */
        public function updatePing() {
            if (Yii::app()->user->id==$this->game_player1) {
                $this->game_player1_ping=time();
            } else {
                $this->game_player2_ping=time();
            }
        }

        /** Adauga o litera unui jucator, schimba statusul jocului daca literele ajung la 5.
         * Apeleaza, la final, $this->save;
         * @param integer $player jucatorul 1 sau jucatorul 2 primeste litera
         * @return void
         *  */

        public function addLetter($player=false) {
            if ($player===false)
                $player=Yii::app()->user->id==$this->game_player1 ? 1 : 2;
            
            if ($player==1)
                $this->game_player1_letters++;
            else
                $this->game_player2_letters++;
            
            if ($this->game_player1_letters==5)
                    $this->game_status=Game::STATUS_P2_WON;
            elseif ($this->game_player2_letters==5)
                    $this->game_status=Game::STATUS_P1_WON;
            
        }
        /**
         * @return bool returns false if an user is not in game anymore
         */
        public function checkPing(){
            if (($this->game_player1 && time()-$this->game_player1_ping>Game::MAX_PING) ||
                ($this->game_player2 && time()-$this->game_player2_ping>Game::MAX_PING)) {
                $this->game_status=Game::STATUS_DISCONNECTED;
                return false;
            }
            return true;
        }
        public function sendTrick() {

        }
        public function doIPlayHere() {
            $u = Yii::app()->user->id;
            if ($this->game_player1==$u || $this->game_player2==$u)
               return true;
            return false;
        }
        public function toggleCurrentPlayer() {
            $this->game_current_player=3-$this->game_current_player;
        }
       
}
