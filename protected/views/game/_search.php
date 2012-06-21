<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'game_id'); ?>
		<?php echo $form->textField($model,'game_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'game_status'); ?>
		<?php echo $form->textField($model,'game_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'game_current_player'); ?>
		<?php echo $form->textField($model,'game_current_player'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'game_current_trick'); ?>
		<?php echo $form->textField($model,'game_current_trick'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'game_player1'); ?>
		<?php echo $form->textField($model,'game_player1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'game_player2'); ?>
		<?php echo $form->textField($model,'game_player2'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'game_player1_ping'); ?>
		<?php echo $form->textField($model,'game_player1_ping',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'game_player2_ping'); ?>
		<?php echo $form->textField($model,'game_player2_ping',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->