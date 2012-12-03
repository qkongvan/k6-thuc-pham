<?php

/**
 * HjQueryUiDialogWidget - Widget dùng để render js Dialog
 * 
 * @author huytbt
 * @date 2011-08-30
 * @version 1.0
 */
class HjQueryUiDialogWidget extends HWidget
{
	/**
     * run - Phương thức dùng để render nội dung widget
     */
    public function run()
    {
		// Đăng ký assets
        $baseScriptUrl = Yii::app()->assetManager->publish(dirname(__FILE__) . '/assets');
        Yii::app()->getClientScript()->registerCoreScript('jquery.ui');
		Yii::app()->getClientScript()->registerScriptFile($baseScriptUrl . '/h.jquery.ui.dialog.js');
    }

}