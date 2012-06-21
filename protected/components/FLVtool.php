<?php
class FLVtool {
    var $dest;
    var $source;
    public function saveFLV() { //actually, it encodes MP4!
        $uniqueFileName = Helper::uniqueFileName($this->dest,".mp4");
        $this->dest .= "/".$uniqueFileName;

        $ffmpeg = new ffmpeg_movie($this->source, false);
        $width = $ffmpeg->getFrameWidth();
        $height = $ffmpeg->getFrameHeight();
        $audioBitRate = $ffmpeg->getAudioBitRate();
        $videoBitRate = $ffmpeg->getVideoBitRate();
        $audioSampleRate = $ffmpeg->getAudioSampleRate();
        $c = "avconv -i ".$this->source." -ar ".$audioSampleRate." -ab ".$audioBitRate." -f mp4 -vcodec libx264 -s ".$width."x".$height." ".$this->dest;  
  //      var_dump($c);
//        die();
        exec($c);
        return $uniqueFileName;
    }
}