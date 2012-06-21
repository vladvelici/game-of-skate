<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'game-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'game_status'); ?>
		<?php echo $form->textField($model,'game_status'); ?>
		<?php echo $form->error($model,'game_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'game_current_player'); ?>
		<?php echo $form->textField($model,'game_current_player'); ?>
		<?php echo $form->error($model,'game_current_player'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'game_current_trick'); ?>
		<?php echo $form->textField($model,'game_current_trick'); ?>
		<?php echo $form->error($model,'game_current_trick'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'game_player1'); ?>
		<?php echo $form->textField($model,'game_player1'); ?>
		<?php echo $form->error($model,'game_player1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'game_player2'); ?>
		<?php echo $form->textField($model,'game_player2'); ?>
		<?php echo $form->error($model,'game_player2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'game_player1_ping'); ?>
		<?php echo $form->textField($model,'game_player1_ping',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'game_player1_ping'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'game_player2_ping'); ?>
		<?php echo $form->textField($model,'game_player2_ping',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'game_player2_ping'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->