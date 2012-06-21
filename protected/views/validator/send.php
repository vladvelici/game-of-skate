<?php
$this->breadcrumbs=array(
	'Validate a trick',
);

$this->menu=array(
	array('label'=>'View my tricks', 'url'=>array('my')),
        array('label'=>'All tricks','url'=>array('/trick/index')),
	array('label'=>'Validation pending', 'url'=>array('validate'),'visible'=>Yii::app()->user->checkAccess("administrator")),
);
?>

<?php if (isset($_GET['msg']) && $_GET['msg']=="sent"): ?>
    <div id='msg-success'>Trick uploaded and will be validated as soon as possible. The status will appear at <em>My tricks</em> section.</div>
<?php endif; ?>

<h1>Validate a<?php if (isset($_GET['msg']) && $_GET['msg']=="sent") echo "nother"; ?> trick</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>