<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tutorial-form',
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
        'method'=>'post',
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'tutorial_trick'); ?>
		<?php echo $form->dropDownList($model,'tutorial_trick',Trick::getList()); ?>
		<?php echo $form->error($model,'tutorial_trick'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tutorial_file'); ?>
		<?php echo $form->fileField($model,'tutorial_file'); ?>
		<?php echo $form->error($model,'tutorial_file'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tutorial_text'); ?>
		<?php echo $form->textArea($model,'tutorial_text',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'tutorial_text'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->