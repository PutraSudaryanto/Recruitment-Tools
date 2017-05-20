<?php
/**
 * @var $this SiteController
 * @var $dataProvider CActiveDataProvider
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (opensource.ommu.co)
 * @link http://company.ommu.co
 * @contact (+62)856-299-4114
 *
 */
?>

<?php if($news->media_show == 1) {
	$images = Yii::app()->request->baseUrl.'/public/page/'.$news->media;
	if($this->adsSidebar == true) {
		if($news->media_type == 1)
			echo '<img class="largemag" src="'.Utility::getTimThumb($images, 600, 900, 3).'" alt="">';
		else
			echo '<img class="mediummag" src="'.Utility::getTimThumb($images, 270, 500, 3).'" alt="">';
	} else {
		if($news->media_type == 1)
			echo '<img class="largemag" src="'.Utility::getTimThumb($images, 1280, 1024, 3).'" alt="">';
		else
			echo '<img class="mediummag" src="'.Utility::getTimThumb($images, 270, 500, 3).'" alt="">';
	}
}?>

<?php echo Phrase::trans($news->name) != Utility::hardDecode(Phrase::trans($news->desc)) ? Utility::cleanImageContent(Phrase::trans($news->desc)) : '';?>