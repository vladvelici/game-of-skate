<?php
$this->breadcrumbs=array(
	'Tricks'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Trick', 'url'=>array('index')),
	array('label'=>'Create Trick', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('trick-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Tricks</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'trick-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'trick_id',
		'trick_name',
		'trick_default_stance',
		'trick_stancechange',
		'trick_popfoot_left',
		'trick_popfoot_top',
		/*
		'trick_popfoot_direction',
		'trick_popfoot_distance',
		'trick_frontfoot_top',
		'trick_frontfoot_left',
		'trick_frontfoot_direction',
		'trick_frontfoot_distance',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
