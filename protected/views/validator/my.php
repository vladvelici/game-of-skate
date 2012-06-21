<?php
$this->breadcrumbs=array(
	'My tricks',
);
Yii::app()->clientScript->registerScriptFile(
	Yii::app()->request->baseUrl.'/protected/components/js/valid.js',
	CClientScript::POS_END
	);
Yii::app()->clientScript->registerCoreScript('jquery');
$this->menu=array(
	array('label'=>'Validate a trick', 'url'=>array('send')),
        array('label'=>'All tricks','url'=>array('/trick/index')),
	array('label'=>'Validation pending list', 'url'=>array('validate'), 'visible'=>Yii::app()->user->checkAccess('administrator')),
);
?>

<h1>My tricks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_my',
));
