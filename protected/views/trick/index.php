<?php
$this->breadcrumbs=array(
	'Tricks',
);

$this->menu=array(
        array('label'=>'My tricks', 'url'=>array('/validator/my')),
        array('label'=>'Validate a trick', 'url'=>array('/validator/send')),
	array('label'=>'Add trick', 'url'=>array('create'), 'visible'=>Yii::app()->user->checkAccess("administrator")),
	array('label'=>'Manage tricks', 'url'=>array('admin'), 'visible'=>Yii::app()->user->checkAccess("administrator")),
);
?>

<h1>Tricks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
