<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('game_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->game_id), array('view', 'id'=>$data->game_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('game_status')); ?>:</b>
	<?php echo CHtml::encode($data->game_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('game_current_player')); ?>:</b>
	<?php echo CHtml::encode($data->game_current_player); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('game_current_trick')); ?>:</b>
	<?php echo CHtml::encode($data->game_current_trick); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('game_player1')); ?>:</b>
	<?php echo CHtml::encode($data->game_player1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('game_player2')); ?>:</b>
	<?php echo CHtml::encode($data->game_player2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('game_player1_ping')); ?>:</b>
	<?php echo CHtml::encode($data->game_player1_ping); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('game_player2_ping')); ?>:</b>
	<?php echo CHtml::encode($data->game_player2_ping); ?>
	<br />

	*/ ?>

</div>