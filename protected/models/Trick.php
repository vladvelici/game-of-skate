<?php

/**
 * This is the model class for table "tricks".
 *
 * The followings are the available columns in table 'tricks':
 * @property integer $trick_id
 * @property string $trick_name
 * @property integer $trick_default_stance
 * @property integer $trick_stancechange
 * @property integer $trick_popfoot_left
 * @property integer $trick_popfoot_top
 * @property integer $trick_popfoot_direction
 * @property integer $trick_popfoot_distance
 * @property integer $trick_frontfoot_top
 * @property integer $trick_frontfoot_left
 * @property integer $trick_frontfoot_direction
 * @property integer $trick_frontfoot_distance
 */
class Trick extends CActiveRecord
{
    public $debuginfo=null;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Trick the static model class
	 */
    
         var $trick_popfoot_left2=false;
         var $trick_popfoot_top2=false;
         var $trick_frontfoot_left2=false;
         var $trick_frontfoot_top2=false;

         const MAX_DIST_OFFSET=50;
         const MAX_ANGLE_OFFSET=40;
         const MAX_FEET_OFFSET=70;

    public function debugInfo() {
        return $this->debuginfo;
    }

    public function debug($t) {
        $this->debuginfo.=' -- '.$t;
    }
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tricks';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('trick_name,
                            trick_popfoot_left,
                            trick_popfoot_top,
                            trick_popfoot_left2,
                            trick_popfoot_top2,
                            trick_frontfoot_top,
                            trick_frontfoot_left,
                            trick_frontfoot_top2,
                            trick_frontfoot_left2,
                            trick_default_stance',
                            'required'),
			array('trick_default_stance, trick_stancechange, trick_popfoot_left, trick_popfoot_top, trick_popfoot_left2, trick_popfoot_top2, trick_frontfoot_top, trick_frontfoot_left, trick_frontfoot_top2, trick_frontfoot_left2', 'numerical', 'integerOnly'=>true),
			array('trick_name', 'length', 'max'=>60),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('trick_id, trick_name, trick_default_stance, trick_stancechange', 'safe', 'on'=>'search'),
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
                    'tutorial'=>array(self::HAS_ONE,'Tutorial','tutorial_trick'),
		);
	}
        public function goofyPositions() {
            return array
                (
                    1 => "Normal",
                    2 => "Fakie",
                    3 => "Switch",
                    4 => "Nollie",
                );
        }
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'trick_id' => 'Trick id',
			'trick_name' => 'Trick name',
			'trick_default_stance' => 'Default position',
			'trick_stancechange' => 'Allow position change',
			'trick_popfoot_left' => 'Trick Popfoot Left',
			'trick_popfoot_top' => 'Trick Popfoot Top',
			'trick_popfoot_direction' => 'Trick Popfoot Direction',
			'trick_popfoot_distance' => 'Trick Popfoot Distance',
			'trick_frontfoot_top' => 'Trick Frontfoot Top',
			'trick_frontfoot_left' => 'Trick Frontfoot Left',
			'trick_frontfoot_direction' => 'Trick Frontfoot Direction',
			'trick_frontfoot_distance' => 'Trick Frontfoot Distance',
		);
	}

        protected function beforeSave() {
            $this -> js2db();
            return true;
        }

        protected function js2db() {
            $this->trick_popfoot_distance = Trick::calcDist(
                        $this->trick_popfoot_left,
                        $this->trick_popfoot_left2,
                        $this->trick_popfoot_top,
                        $this->trick_popfoot_top2);
            $this->trick_frontfoot_distance = Trick::calcDist(
                        $this->trick_frontfoot_left,
                        $this->trick_frontfoot_left2,
                        $this->trick_frontfoot_top,
                        $this->trick_frontfoot_top2);
    	    if ($this->trick_popfoot_distance<=Trick::MAX_DIST_OFFSET)
    		    $this->trick_popfoot_direction=0;
    	    else
    		    $this->trSick_popfoot_direction = Trick::calcAngle(
    		                $this->trick_popfoot_left,
    		                $this->trick_popfoot_left2,
    		                $this->trick_popfoot_top,
    		                $this->trick_popfoot_top2);
    	    if ($this->trick_frontfoot_direction<=Trick::MAX_DIST_OFFSET)
    		    $this->trick_frontfoot_direction=0;
    	    else
    		    $this->trick_frontfoot_direction = Trick::calcAngle(
    		                $this->trick_frontfoot_left,
    		                $this->trick_frontfoot_left2,
    		                $this->trick_frontfoot_top,
    		                $this->trick_frontfoot_top2);
            }
        protected function db2js() {
            //pop foot
            if ($this->trick_popfoot_left2===false || $this->trick_popfoot_top2===false) {
                list($cadr,$a)=Trick::calcCadran($this->trick_popfoot_direction);
                $coords=Trick::calcPoint2Coords(
                        $this->trick_popfoot_left,
                        $this->trick_popfoot_top,
                        $a,
                        $this->trick_popfoot_distance,
                        $cadr);
                $this->trick_popfoot_left2=$coords[0];
                $this->trick_popfoot_top2=$coords[1];
            }
            //front foot
            if ($this->trick_frontfoot_left2===false || $this->trick_frontfoot_top2===false) {
                list($cadr,$a)=Trick::calcCadran($this->trick_frontfoot_direction);
                $coords=Trick::calcPoint2Coords(
                        $this->trick_frontfoot_left,
                        $this->trick_frontfoot_top,
                        $a,
                        $this->trick_frontfoot_distance,
                        $cadr);
                $this->trick_frontfoot_left2=$coords[0];
                $this->trick_frontfoot_top2=$coords[1];
            }
        }
        public function beforeThePreview() {
            $this->db2js();
        }
        public function calcPoint2Coords($x1,$y1,$angle,$dist,$cadr) {
                if ($cadr==1) {
                    $x2t = round(cos(deg2rad($angle))*$dist);
                    $x2 = $x1+$x2t;
                    $y2t = round(sin(deg2rad($angle))*$dist);
                    $y2 = $y1-$y2t;
                } elseif ($cadr==2) {
                    $x2t = round(sin(deg2rad($angle))*$dist);
                    $x2 = $x1-$x2t;
                    $y2t = round(cos(deg2rad($angle))*$dist);
                    $y2 = $y1-$y2t;
                } elseif ($cadr==3) {
                    $x2t = round(cos(deg2rad($angle))*$dist);
                    $x2 = $x1-$x2t;
                    $y2t = round(sin(deg2rad($angle))*$dist);
                    $y2 = $y1+$y2t;
                } else {
                    $x2t = round(sin(deg2rad($angle))*$dist);
                    $x2 = $x1+$x2t;
                    $y2t = round(cos(deg2rad($angle))*$dist);
                    $y2 = $y1+$y2t;
                }
                return array($x2,$y2,$x2t,$y2t);
        }

        public function calcCadran($direction) {
            $c=1;
            while ($direction>90) {
                $c++;
                $direction-=90;
            }
            return array($c,$direction);
        }

        public function calcDist($x1, $x2, $y1, $y2) {
            $x=max($x1,$x2)-min($x1,$x2);
            $y=max($y1,$y2)-min($y1,$y2);
            return round(sqrt(($x*$x)+($y*$y)));
        }

        public function calcAngle($x1,$x2,$y1,$y2) {
            if ($x2>$x1 && $y2<$y1) { //cadran 1
                $a = (float) ($y1-$y2)/($x2-$x1);
                $d=0;
            } elseif ($x2<$x1 && $y2<$y1) { //cadran 2
                $a = (float) ($x1-$x2)/($y1-$y2);
                $d = 90;
            } elseif ($x2<$x1 && $y2>$y1) { //cadran 3
                if ($x1-$x2==0) return ;
                $a = (float) ($y2-$y1)/($x1-$x2);
                $d = 180;
            } elseif ($x2>$x1 && $y2>$y1) { //cadran 4
                $a = (float) ($x2-$x1)/($y2-$y1);
                $d = 270;
            } elseif ($y1==$y2 && $x2>$x1) {
                return 0;
            } elseif ($y1==$y2 && $x2<$x1) {
                return 180;
            } elseif ($x1==$x2 && $y2>$y1) {
                return 270;
            } elseif ($x1==$x2 && $y2<$y1) {
                return 90;
            } else {
                return 0;
            }
            return round(rad2deg(atan($a)))+$d;
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
		$criteria->compare('trick_id',$this->trick_id);
		$criteria->compare('trick_name',$this->trick_name,true);
		$criteria->compare('trick_default_stance',$this->trick_default_stance);
		$criteria->compare('trick_stancechange',$this->trick_stancechange);
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

        /**
         * input array::
         *  pop_x1,pop_x2,pop_y1,pop_y2 = pop foot and direction coords
         * front_x1,front_x2,front_y1,front_y2 -front foot and direction coords
         * pos - position
         * @return array $coords coordonatele picioarelor in goofy.normal
         * @param array coordonaltele picioarelor in goofy.*
         */
        public function toGoofy($coords) {
            if ($coords['pos']==2) {
                $coords = self::flip_h($coords);
                $coords = self::flip_v($coords);
            } elseif ($coords['pos']==3) {
                $coords = self::flip_v($coords);
            } elseif ($coords['pos']==4) {
                $coords = self::flip_h($coords);
            }
            return $coords;
        }

        public function flip_h($coords,$maxX=600) {
            $coords['pop_x1']=$maxX-$coords['pop_x1'];
            $coords['pop_x2']=$maxX-$coords['pop_x2'];
            $coords['front_x1']=$maxX-$coords['front_x1'];
            $coords['front_x2']=$maxX-$coords['front_x2'];
            return $coords;
        }
        public function flip_v($coords,$maxY=400) {
            $coords['pop_y1']=$maxY-$coords['pop_y1'];
            $coords['pop_y2']=$maxY-$coords['pop_y2'];
            $coords['front_y1']=$maxY-$coords['front_y1'];
            $coords['front_y2']=$maxY-$coords['front_y2'];
            return $coords;
        }
        public function trickName($id) {
            $search = new CDbCriteria;
            $search->select="trick_name";
            $model = Trick::model()->findByPk($id,$search);
            if ($model===null) return "0";
            return $model->trick_name;
        }
        public function findByTrick($coords) {

            // print to file
            $f = fopen('/var/www/tricklog', 'w+');

           $coords=$this->toGoofy($coords);
            fwrite($f, json_encode($coords)."\n");
           $search=new CDbCriteria;

           $search->addBetweenCondition("trick_popfoot_top",
                   $coords['pop_y1']-Trick::MAX_FEET_OFFSET,
                   $coords['pop_y1']+Trick::MAX_FEET_OFFSET);
           $search->addBetweenCondition("trick_popfoot_left",
                   $coords['pop_x1']-Trick::MAX_FEET_OFFSET,
                   $coords['pop_x1']+Trick::MAX_FEET_OFFSET);

           $search->addBetweenCondition("trick_frontfoot_top",
                   $coords['front_y1']-Trick::MAX_FEET_OFFSET,
                   $coords['front_y1']+Trick::MAX_FEET_OFFSET);
           $search->addBetweenCondition("trick_frontfoot_left",
                   $coords['front_x1']-Trick::MAX_FEET_OFFSET,
                   $coords['front_x1']+Trick::MAX_FEET_OFFSET);

           $pop_dist = $this->calcDist(
                   $coords['pop_x1'],
                   $coords['pop_x2'],
                   $coords['pop_y1'],
                   $coords['pop_y2']);
           $front_dist = $this->calcDist(
                   $coords['front_x1'],
                   $coords['front_x2'],
                   $coords['front_y1'],
                   $coords['front_y2']);

    	   if ($pop_dist<=Trick::MAX_DIST_OFFSET) {
    		      $search->addCondition("trick_popfoot_distance<".Trick::MAX_DIST_OFFSET);
    		      // $search->addCondition("trick_popfoot_direction=0");
            } else {
               	$pop_angle = $this->calcAngle(
                       $coords['pop_x1'],
                       $coords['pop_x2'],
                       $coords['pop_y1'],
                       $coords['pop_y2']);

        		$search->addBetweenCondition("trick_popfoot_distance",
        			   $pop_dist-Trick::MAX_DIST_OFFSET,
        			   $pop_dist+Trick::MAX_DIST_OFFSET);
        		$search->addBetweenCondition("trick_popfoot_direction",
        			   self::fixAngleOffset($pop_angle-Trick::MAX_ANGLE_OFFSET),
        			   self::fixAngleOffset($pop_angle+Trick::MAX_ANGLE_OFFSET));
    	   }

    	   if ($front_dist<=Trick::MAX_DIST_OFFSET) {
                $search->addCondition('trick_frontfoot_distance<'.Trick::MAX_DIST_OFFSET);
    	   } else {
               	$front_angle = $this->calcAngle(
                       $coords['front_x1'],
                       $coords['front_x2'],
                       $coords['front_y1'],
                       $coords['front_y2']);

               $search->addBetweenCondition("trick_frontfoot_distance",
                       $front_dist-Trick::MAX_DIST_OFFSET,
                       $front_dist+Trick::MAX_DIST_OFFSET);
               $search->addBetweenCondition("trick_frontfoot_direction",
                       $front_angle-Trick::MAX_ANGLE_OFFSET,
                       $front_angle+Trick::MAX_ANGLE_OFFSET);
           }

            fwrite($f, json_encode($search->toArray())."\n ***** \n");
            fclose($f);
           return $this->find($search);
        }
	public function fixAngleOffset($deg) {
		if ($deg<0) 
			return 360+$deg;
		if ($deg>359)
			return $deg-360;
		return $deg;
	}
        public function getList() {
            $search = new CDbCriteria;
            $search->select="trick_id, trick_name";
            $m = Trick::model()->findAll($search);
            $result = array();
            foreach ($m as $obj) {
                $result[$obj->trick_id]=$obj->trick_name;
            }
            return $result;
        }

}
