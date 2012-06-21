<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
            	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
	)); ?><!-- breadcrumbs -->
                  <div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
                <div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
                                array('label'=>'Tricks','url'=>array('/trick/index')),
                                array('label'=>'Play!','url'=>array('/game/index')),
                                array('label'=>'Validate','url'=>array('/validator/send')),
			),
		)); ?>
                </div><!-- mainmenu -->
                <div id="howitworks">
                    <?php echo CHtml::link(
                            "<img src='".Yii::app()->request->baseUrl."/images/howitworks.gif' alt='how it works?'/>",
                            array("/site/page",'view'=>'about')); ?>
                    
                </div>
              <div id="userinfo">
                    <span class="usrname">
                        <?php
                        if (Yii::app()->user->isGuest)
                            echo "Guest";
                        else
                            echo Yii::app()->user->name;
                        ?>
                    </span>
                    <?php
                    $this->widget('zii.widgets.CMenu',array(
                        'items'=>array(
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                            	array('label'=>'Register', 'url'=>array('/site/register'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Reset password', 'url'=>array('/site/reset'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'My profile', 'url'=>array('/user/view','id'=>Yii::app()->user->id), 'visible'=>!Yii::app()->user->isGuest),
                                array('label'=>'My account', 'url'=>array('/user/update'), 'visible'=>!Yii::app()->user->isGuest),
                                array('label'=>'My tricks', 'url'=>array('/validator/my'), 'visible'=>!Yii::app()->user->isGuest),
                                array('label'=>'Logout', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                        ),
                    ));
                    ?>
                </div>
        </div><!-- header -->
        <div class="clear"></div>

	<?php echo $content; ?>
        <div class="clear"></div>
	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by online Game of Skate.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->


</div><!-- page -->

</body>
</html>
