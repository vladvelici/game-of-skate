<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->user_id), array('view', 'id'=>$data->user_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_name')); ?>:</b>
	<?php echo CHtml::encode($data->user_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_email')); ?>:</b>
	<?php echo CHtml::encode($data->user_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_points')); ?>:</b>
	<?php echo CHtml::encode($data->user_points); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_joined')); ?>:</b>
	<?php echo CHtml::encode($data->user_joined); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('user_last_login')); ?>:</b>
	<?php echo CHtml::encode($data->user_last_login); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_last_ip')); ?>:</b>
	<?php echo CHtml::encode($data->user_last_ip); ?>
	<br />

	*/ ?>

</div>