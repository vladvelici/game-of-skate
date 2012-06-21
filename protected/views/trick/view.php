<?php
$this->breadcrumbs=array(
	'Tricks'=>array('index'),
	$model->trick_name,
);

$this->menu=array(
	array('label'=>'All tricks', 'url'=>array('index')),
        array('label'=>'My tricks', 'url'=>array('/validator/my')),
        array('label'=>'Validate this trick', 'url'=>array('/validator/send','id'=>$model->trick_id)),
	array('label'=>'Add trick', 'url'=>array('create'), 'visible'=>Yii::app()->user->checkAccess("administrator")),
	array('label'=>'Edit trick', 'url'=>array('update', 'id'=>$model->trick_id), 'visible'=>Yii::app()->user->checkAccess("administrator")),
	array('label'=>'Delete trick', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->trick_id),'confirm'=>'Are you sure you want to delete this item?'), 'visible'=>Yii::app()->user->checkAccess("administrator")),
	array('label'=>'Manage tricks', 'url'=>array('admin'), 'visible'=>Yii::app()->user->checkAccess("administrator")),
);
?>

<h1><?php echo $model->trick_name; ?></h1>
<?php if ($model->tutorial!==null) :?>
    <div class="trickViewDiv">
        <?php
        $this->renderPartial("//site/_video",
                array(
                    'videoFile' => Yii::app()->request->baseUrl."/video/tutorial/".$model->tutorial->tutorial_file,
                    'divClass'=>'validator_video',
                    'width'=>400,
                    'height'=>300,
                     )
                );
        ?>
        <h2>in real life</h2>
    <?php echo nl2br(CHtml::encode($model->tutorial->tutorial_text)); ?>
    </div>
<?php endif; ?>
<?php
if (Yii::app()->user->checkAccess("administrator")) {
    echo "<br /><br />";
    if ($model->tutorial===null)
        echo CHtml::link("Add in-life video tutorial",array('tutorial/create'));
    else
        echo CHtml::link("Change in-life video tutorial",array('tutorial/update','id'=>$model->tutorial->tutorial_id));
}
?>
<div class="clear"></div>

<div class="trickViewDiv">
    <h2>in game</h2>
    <div id="inputSkateTrick">
        <div id="popfoot1" class="pop1" style="display:inline-block;top:<?php echo ($model->trick_popfoot_top-20); ?>px;left:<?php echo ($model->trick_popfoot_left-17); ?>px;"></div>
        <div id="popfoot2" style="display:inline-block;top:<?php echo ($model->trick_popfoot_top2-20); ?>px;left:<?php echo ($model->trick_popfoot_left2-17); ?>px;"></div>
        <div id="frontfoot1" style="display:inline-block;top:<?php echo ($model->trick_frontfoot_top-20); ?>px;left:<?php echo ($model->trick_frontfoot_left-17); ?>px;"></div>
        <div id="frontfoot2" style="display:inline-block;top:<?php echo ($model->trick_frontfoot_top2-20); ?>px;left:<?php echo ($model->trick_frontfoot_left2-17); ?>px;"></div>
    </div>
    
</div>
