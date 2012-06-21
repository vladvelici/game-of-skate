<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->user_name,
);

$this->menu=array(
	array('label'=>'Users list', 'url'=>array('index')),
	array('label'=>'My account', 'url'=>array('update', 'id'=>$model->user_id), 'visible'=>Yii::app()->user->id===$model->user_id),
	array('label'=>'Delete user', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->user_id),'confirm'=>'Are you sure you want to delete this item?'),'visible'=>Yii::app()->user->checkAccess("administrator")),
	array('label'=>'Manage users', 'url'=>array('admin'), 'visible'=>Yii::app()->user->checkAccess("administrator")),
);
?>

<h1><?php echo $model->user_name; ?>'s profile</h1>

<div class="profilerow"><strong>E-mail adress: </strong><br /><?php echo $model->user_email; ?></div>
<div class="profilerow"><strong>Points: </strong><br /><?php echo $model->user_points; ?></div>
<div class="profilerow"><strong>Date joined: </strong><br /><?php echo date("j F, Y",$model->user_joined); ?></div>
<div class="profilerow"><strong>Last visit: </strong><br /><?php echo date("j F, Y",$model->user_last_login); ?></div>
