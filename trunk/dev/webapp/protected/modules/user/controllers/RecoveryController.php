<?php

/**
 * Controller Recovery dùng để hỗ trợ cho việc lấy lại mật khẩu của user
 * 
 * @author huytbt
 * @date 2011-06-01
 * @version 1.0
 */
class RecoveryController extends HController {

    /**
     * actions
     */
    public function actions() {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
        );
    }

    /**
     * Action ForgotPassword dùng để gửi email phục vụ việc đổi mật khẩu
     */
    public function actionForgotPassword() {
        $model = new ForgotPasswordForm;

        if (isset($_POST['ForgotPasswordForm'])) {
            $model->attributes = $_POST['ForgotPasswordForm'];

            // Validate username or email existed?
            if ($model->validate()) {
                // Delete old Code forgot password
                $model->user->activkey = $model->user->createCodeActivation();
                $model->user->save();

                // Create Code forgot password
                $codeForgotPassword = $model->user->activkey;

                if ($codeForgotPassword != '') {
                    /**
                     * @todo Change message email
                     */
                    $strForgotPasswordUrl = $this->createAbsoluteUrl('/user/recovery/changepassword', array("code" => $codeForgotPassword, "email" => $model->user->email));
                    $strMsgHTML = "<a href='{$strForgotPasswordUrl}'>{$strForgotPasswordUrl}</a>";
                    Yii::import('application.extensions.phpmailer.HMailHelper');
                    HMailHelper::Send('Recovery Password', $strMsgHTML, array(array($model->user->email, '')));

                    // Notice Sent mail success
                    $this->setRedirectOptions(array(
                        "title" => UserModule::t('Sent Mail Success'),
                        "message" => UserModule::t('Access to the email to change your password!'),
                    ));
                    $this->redirect(Yii::app()->user->loginUrl);
                }
            }
        }

        $this->render('forgotpassword', array('model' => $model));
    }

    /**
     * Action ChangePassword dùng để đổi mật khẩu cho user khi user quên mật khẩu với điều kiện user click url được gửi trong email
     */
    public function actionChangePassword() {
        // Validate Code forgot password
        if (isset($_GET['code']) && isset($_GET['email'])) {
            $strForgotPasswordCode = $_GET['code'];
            $strEmail = $_GET['email'];
            $user = User::model()->notsafe()->findByAttributes(array('email' => $strEmail));
            if (isset($user)) {
                // Check Code
                if ($strForgotPasswordCode == $user->activkey) {
                    $model = new ChangePasswordForm;

                    // Submit form
                    if (isset($_POST['ChangePasswordForm'])) {
                        $model->attributes = $_POST['ChangePasswordForm'];

                        // Validate new password
                        if ($model->validate()) {
                            // Create new Pasword
                            $user->encryptPassword($model->password);

							// Delete forgot code in DB
							$user->activkey = $user->createCodeActivation();
                            // Save new password to DB
                            if ($user->save()) {
                            }

                            /**
                             * @todo Change message email
                             */
                            $strMsgHTML = "Recovery Password Success";
                            Yii::import('application.extensions.phpmailer.HMailHelper');
                            HMailHelper::Send('Recovery Password', $strMsgHTML, array(array($user->email, $user->username)));

                            // Notice Recovery Password success
                            $this->setRedirectOptions(array(
                                "title" => UserModule::t('Recovery Password Success'),
                                "message" => UserModule::t('The recovery password was successful!'),
                            ));
                            $this->redirect(Yii::app()->user->loginUrl);
                        }
                    }

                    $this->render('changepassword', array('model' => $model));

                    Yii::app()->end();
                } else {
                    // Notice recovery password failure
                    $this->setRedirectOptions(array(
                        "title" => UserModule::t('Recovery Password Failure'),
                        "message" => UserModule::t('Incorrect recovery URL or Recovery period has expired!'),
                    ));
                    $this->redirect("/");
                }
            }
        }

        // Notice recovery password failure
        $this->setRedirectOptions(array(
            "title" => UserModule::t('Recovery Password Failure'),
            "message" => UserModule::t('Incorrect recovery URL!'),
        ));
        $this->redirect("/");
    }

}
