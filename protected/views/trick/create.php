<?php
$this->breadcrumbs=array(
	'Tricks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Trick', 'url'=>array('index')),
	array('label'=>'Manage Trick', 'url'=>array('admin')),
);
?>

<h1>Create Trick</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>