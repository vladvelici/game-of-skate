<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_name'); ?>
		<?php echo $form->textField($model,'user_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_salt'); ?>
		<?php echo $form->textField($model,'user_salt',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_email'); ?>
		<?php echo $form->textField($model,'user_email',array('size'=>60,'maxlength'=>254)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_points'); ?>
		<?php echo $form->textField($model,'user_points',array('size'=>7,'maxlength'=>7)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_joined'); ?>
		<?php echo $form->textField($model,'user_joined'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_last_login'); ?>
		<?php echo $form->textField($model,'user_last_login'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_last_ip'); ?>
		<?php echo $form->textField($model,'user_last_ip',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->