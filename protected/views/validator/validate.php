<?php
$this->breadcrumbs=array(
	'Validation pending list',
);
Yii::app()->clientScript->registerScriptFile(
	Yii::app()->request->baseUrl.'/protected/components/js/valid.js',
	CClientScript::POS_END
	);
Yii::app()->clientScript->registerCoreScript('jquery');
$this->menu=array(
	array('label'=>'Validate a trick', 'url'=>array('send')),
	array('label'=>'My tricks', 'url'=>array('my')),
        array('label'=>'All tricks', 'url'=>array('/trick/index')),
);
?>

<h1>Validation pending list:</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_validate',
)); ?>
