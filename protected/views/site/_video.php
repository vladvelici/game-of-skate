<div class="<?php echo $divClass; ?>">
    <object id="player" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player" width="<?php echo $width; ?>" height="<?php echo $height; ?>">
        <param name="movie" value="<?php echo Yii::app()->request->baseUrl; ?>/video/player.swf" />
        <param name="allowfullscreen" value="true" />
        <param name="allowscriptaccess" value="always" />
        <param name="flashvars" value="file=<?php echo $videoFile; ?>" />
        <embed
                type="application/x-shockwave-flash"
                id="player2"
                name="player2"
                src="<?php echo Yii::app()->request->baseUrl; ?>/video/player.swf"
                width="<?php echo $width; ?>"
                height="<?php echo $height; ?>"
                allowscriptaccess="always"
                allowfullscreen="true"
                flashvars="file=<?php echo $videoFile; ?>"
        />
    </object>
</div>