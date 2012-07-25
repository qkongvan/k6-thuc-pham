<?php

/**
 * @class       LogoutController
 * @ingroup     application.modules.user.controllers
 * @brief       Controller phục vụ cho việc login
 * @author      huytbt
 * @version     1.0
 * @date        2011-05-23
 */
class LogoutController extends HController {

    /**
     * @return string Trả về các action (cách nhau bằng dấu phẩy) cho phép truy cập mà không cần xác thực quyền
     */
    public function allowedActions() {
        return '*';
    }

    /**
     * Action dùng để logout
     */
    public function actionIndex() {
        Yii::app()->user->logout();

		$this->setRedirectOptions(array(
            "title" => UserModule::t('Thanks'),
            "message" => UserModule::t('You are now signed out '),
        ));
        
        $this->redirect(Yii::app()->user->loginUrl);
    }

}