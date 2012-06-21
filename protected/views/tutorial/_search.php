<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'tutorial_id'); ?>
		<?php echo $form->textField($model,'tutorial_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tutorial_trick'); ?>
		<?php echo $form->textField($model,'tutorial_trick'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tutorial_file'); ?>
		<?php echo $form->textField($model,'tutorial_file',array('size'=>35,'maxlength'=>35)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tutorial_text'); ?>
		<?php echo $form->textArea($model,'tutorial_text',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tutorial_cache'); ?>
		<?php echo $form->textField($model,'tutorial_cache',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->