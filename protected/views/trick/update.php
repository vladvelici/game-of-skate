<?php
$this->breadcrumbs=array(
	'Tricks'=>array('index'),
	$model->trick_name=>array('view','id'=>$model->trick_id),
	'Edit',
);

$this->menu=array(
	array('label'=>'List Trick', 'url'=>array('index')),
	array('label'=>'Create Trick', 'url'=>array('create')),
	array('label'=>'View Trick', 'url'=>array('view', 'id'=>$model->trick_id)),
	array('label'=>'Manage Trick', 'url'=>array('admin')),
);
?>

<h1>Update Trick <?php echo $model->trick_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>