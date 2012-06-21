<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'trick_id'); ?>
		<?php echo $form->textField($model,'trick_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'trick_name'); ?>
		<?php echo $form->textField($model,'trick_name',array('size'=>60,'maxlength'=>60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'trick_default_stance'); ?>
		<?php echo $form->textField($model,'trick_default_stance'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'trick_stancechange'); ?>
		<?php echo $form->textField($model,'trick_stancechange'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'trick_popfoot_left'); ?>
		<?php echo $form->textField($model,'trick_popfoot_left'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'trick_popfoot_top'); ?>
		<?php echo $form->textField($model,'trick_popfoot_top'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'trick_popfoot_direction'); ?>
		<?php echo $form->textField($model,'trick_popfoot_direction'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'trick_popfoot_distance'); ?>
		<?php echo $form->textField($model,'trick_popfoot_distance'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'trick_frontfoot_top'); ?>
		<?php echo $form->textField($model,'trick_frontfoot_top'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'trick_frontfoot_left'); ?>
		<?php echo $form->textField($model,'trick_frontfoot_left'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'trick_frontfoot_direction'); ?>
		<?php echo $form->textField($model,'trick_frontfoot_direction'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'trick_frontfoot_distance'); ?>
		<?php echo $form->textField($model,'trick_frontfoot_distance'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->