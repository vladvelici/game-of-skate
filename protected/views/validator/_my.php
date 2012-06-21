<div class="pendingTricks">

    <?php
    $this->renderPartial("//site/_video",
            array(
                'videoFile' => Yii::app()->request->baseUrl."/video/validator/".$data->validation_file,
                'divClass'=>'validator_video',
                'width'=>400,
                'height'=>300,
                 )
            );
    ?>

    <div class="trick">
    <?php echo CHtml::encode($data->trick->trick_name); ?>
    </div>
    <div class="user">Status:

	<?php 
		if ($data->validation_status==0)
			echo "<span style='font-color:#009;'>Not verified yet...</span>";
		elseif ($data->validation_status==1)
			echo "<span style='font-color:#090;'>Valid</span>";
		else
			echo "<span style='font-color:#900;'>Not valid</span>";
	?>

    </div>

    <div class="clear"></div>
</div>
