<?php
$opponent = $model->game_player1 == Yii::app()->user->id ?
        User::getName($model->game_player2) :
        User::getName($model->game_player1);

$this->breadcrumbs=array(
	'Game'=>array('index'),
	"Playing with ".$opponent,
);

Yii::app()->clientScript->registerCssFile(
        Yii::app()->request->baseUrl.'/css/ingame.css',
        'screen, projection');

Yii::app()->clientScript->registerScriptFile(
	Yii::app()->request->baseUrl.'/js/playing.js',
	CClientScript::POS_END
	);
Yii::app()->clientScript->registerCoreScript('jquery');
?>
<script type="text/javascript">
    var youAre=<?php echo ($model->game_player1 == Yii::app()->user->id ? 1 : 2); ?>;
    var gameId=<?php echo $model->game_id; ?>
</script>
<div id="gameContainer">
    <div id="statusbar">
        <div id="players">
            <div id="player1"<?php echo (Yii::app()->user->id == $model->game_player1 ? " class='playerMe'" : "");?>>
                <span class="score">-----</span>
                <span class="toTrick">&rsaquo;</span>
                <span class="pName">
                <?php
                  echo User::getName($model->game_player1);
                ?>
                </span>
            </div>
            <div id="player2"<?php echo (Yii::app()->user->id == $model->game_player2 ? " class='playerMe'" : "");?>>
                <span class="score">-----</span>
                <span class="toTrick">&rsaquo;</span>
                <span class="pName">
                <?php
                    if ($model->game_player2 != 0) {
                        echo User::getName($model->game_player2);
                    } else
                        echo "<strong>waiting for an opponent</strong>";
                ?>
                </span>
            </div>
        </div>
    
        <div id="timeRemaining">
            -
        </div>
        <div id="currentTrick">
            chose trick
        </div>
    </div>
    <div id="inputSkateTrick">
        <div id="wait">Waiting for your opponent...</div>
        <span id="status"></span>
        <div id="popfoot1"></div>
        <div id="popfoot2"></div>
        <div id="frontfoot1"></div>
        <div id="frontfoot2"></div>
    </div>
</div>

