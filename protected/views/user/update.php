<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->user_name=>array('view','id'=>$model->user_id),
	'Edit my account',
);

$this->menu=array(
	array('label'=>'My profile', 'url'=>array('view', 'id'=>$model->user_id)),
	array('label'=>'My tricks', 'url'=>array('/validator/my')),
	array('label'=>'View all users', 'url'=>array('index')),
	array('label'=>'Manage User', 'url'=>array('admin'), 'visible'=>Yii::app()->user->checkAccess("administrator")),
);
?>

<h1><?php echo $model->user_name; ?> -- edit account</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
