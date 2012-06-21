<?php
$this->breadcrumbs=array(
	'Games'=>array('index'),
	$model->game_id,
);

$this->menu=array(
	array('label'=>'List Game', 'url'=>array('index')),
	array('label'=>'Create Game', 'url'=>array('create')),
	array('label'=>'Update Game', 'url'=>array('update', 'id'=>$model->game_id)),
	array('label'=>'Delete Game', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->game_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Game', 'url'=>array('admin')),
);
?>

<h1>View Game #<?php echo $model->game_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'game_id',
		'game_status',
		'game_current_player',
		'game_current_trick',
		'game_player1',
		'game_player2',
		'game_player1_ping',
		'game_player2_ping',
	),
)); ?>
