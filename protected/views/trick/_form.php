<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'trick-form',
	'enableAjaxValidation'=>false,
));
Yii::app()->clientScript->registerScriptFile(
	Yii::app()->request->baseUrl.'/protected/components/js/addtrick.js',
	CClientScript::POS_END
	);
?>


	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'trick_name'); ?>
		<?php echo $form->textField($model,'trick_name',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'trick_name'); ?>
	</div>
        <div id="inputSkateTrick">
            <span id="status"></span>
            <div id="popfoot1"></div>
            <div id="popfoot2"></div>
            <div id="frontfoot1"></div>
            <div id="frontfoot2"></div>
        </div>
        <div class="row">
                <?php echo CHtml::link("Reset trick", "javascript:resetTrick();"); ?>
        </div>

        <?php echo $form->hiddenField($model,'trick_stancechange', array('value'=>1)); ?>
        <?php echo $form->hiddenField($model,'trick_default_stance', array('maxlength'=>1)); ?>
        <?php echo $form->hiddenField($model,'trick_popfoot_left'); ?>
        <?php echo $form->hiddenField($model,'trick_popfoot_top'); ?>
        <?php echo $form->hiddenField($model,'trick_popfoot_top2'); ?>
        <?php echo $form->hiddenField($model,'trick_popfoot_left2'); ?>
        <?php echo $form->hiddenField($model,'trick_frontfoot_top'); ?>
        <?php echo $form->hiddenField($model,'trick_frontfoot_left'); ?>
        <?php echo $form->hiddenField($model,'trick_frontfoot_top2'); ?>
        <?php echo $form->hiddenField($model,'trick_frontfoot_left2'); ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
        <script type="text/javascript">
            var trickEdit=<?php echo ($model->isNewRecord ? "false" : "true"); ?>;
        </script>
<?php $this->endWidget(); ?>

</div><!-- form -->