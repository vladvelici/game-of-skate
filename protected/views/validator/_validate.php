<div class="pendingTricks" id="vtrick_<?php echo $data->validation_id; ?>">

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
    <div class="user">by <span><?php echo $data->user->user_name; ?></span></div>
    <?php
        echo CHtml::link("Valid",
                        array("/validator/validateIt",
                            "id"=>$data->validation_id,
                            "status"=>1,
                        ),
                        array('id'=>'valid_'.$data->validation_id));
        echo CHtml::link("Invalid",
                        array("/validator/validateIt",
                            "id"=>$data->validation_id,
                            "status"=>0,
                        ),
                        array('id'=>'invalid_'.$data->validation_id));

    ?>
    <script type="text/javascript">
        $('#valid_<?php echo $data->validation_id; ?>').click(function(e) {
            e.preventDefault();
            validate(<?php echo $data->validation_id; ?>,1);
        });
        $('#invalid_<?php echo $data->validation_id; ?>').click(function(e) {
            e.preventDefault();
            validate(<?php echo $data->validation_id; ?>,0);
        });
    </script>
    <div id="vtrick_err_<?php echo $data->validation_id; ?>" style="display:none;"></div>
    <div class="clear"></div>
</div>