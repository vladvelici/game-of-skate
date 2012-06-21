<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'validator-form',
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
        'method'=>'post',
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'validation_trick'); ?>
		<?php echo $form->dropDownList($model,'validation_trick',Trick::getList()); ?>
		<?php echo $form->error($model,'validation_trick'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'validation_file'); ?>
		<?php echo $form->fileField($model,'validation_file'); ?>
		<?php echo $form->error($model,'validation_file'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->