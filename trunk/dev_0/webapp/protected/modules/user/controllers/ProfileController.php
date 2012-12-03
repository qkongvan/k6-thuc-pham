<?php

/**
 * Controller Profile dùng để phục vụ cho việc thay đổi hồ sơ cá nhân của user
 * 
 * @author huytbt
 * @date 2011-06-01
 * @version 1.0
 */

/**
 * @todo Thêm Avatar cho user
 * @todo Thêm field động lấy từ CSDL
 */
class ProfileController extends HController
{
    /**
     * Thiết lập action mặc định cho Controller
     */
    public $defaultAction = 'index';

    /**
     * Action View dùng để hiển thị hồ sơ của user
     */
    public function actionIndex() {
        // Get Information User
        $model = User::model()->findByPk(Yii::app()->user->id);

        // Get list roles of User
        //$arrRoles = Rights::getAssignedRoles(Yii::app()->user->id);
        //$roles = array();
        //foreach ($arrRoles as $name => $role) {
        //    array_push($roles, $role->description);
        //}

        $this->render('index', array('model' => $model));
    }

    /**
     * Action Update dùng để cập nhật hồ sơ user
     */
    public function actionUpdate() {
        $model = User::model()->findByPk(Yii::app()->user->id);

        // Submit form
        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];

            // Validate & Save info to DB
            if ($model->validate() && $model->save()) {
                // Notice to user Update success
                $this->setRedirectOptions(array(
                    "title" => UserModule::t('Update Success'),
                    "message" => UserModule::t('The update profile was successful!'),
                ));
                $this->redirect('/user/profile');
            }
        }

        $this->render('update', array('model' => $model));
    }

    /**
     * Action ChangePassword dùng để đổi mật khẩu của user
     */
    public function actionChangePassword() {
        $model = new ChangePasswordForm('fullchange');

        // Submit form
        if (isset($_POST['ChangePasswordForm'])) {
            $user = User::model()->notsafe()->findByPk(Yii::app()->user->id);
            $model->user = $user;

            $model->attributes = $_POST['ChangePasswordForm'];

            // Validate info
            if ($model->validate()) {
                // Save new password
                $user->encryptPassword($model->password);

                // Save new password to DB
                if ($user->save()) {
                    // Notice Recovery Password success
                    $this->setRedirectOptions(array(
                        "title" => UserModule::t('Change Password Success'),
                        "message" => UserModule::t('The change password was successful!'),
                    ));
                    $this->redirect('/user/profile');
                }
            }
        }

        $this->render('changepassword', array('model' => $model));
    }

    /**
     * Action ChangeEmail dùng để đổi email của user
     */
    public function actionChangeEmail() {
        // Bước 1: Người dùng yêu cầu change email
        if (empty($_GET['code'])) {
            // Submit form
            if (isset($_POST['changepassword'])) {
                $user = User::model()->notsafe()->findByPk(Yii::app()->user->id);

                $user->activkey = $user->createCodeActivation();
                $user->save();

                // Create Code change email
                $codeChangeEmail = $user->activkey;

                if ($codeChangeEmail != '') {
                    /**
                     * @todo Change message email
                     */
                    $strChangeEmailUrl = $this->createAbsoluteUrl('/user/profile/changeemail', array("code" => $codeChangeEmail));
                    $strMsgHTML = "<a href='{$strChangeEmailUrl}'>{$strChangeEmailUrl}</a>";
                    Yii::import('application.extensions.phpmailer.HMailHelper');
                    HMailHelper::Send('Change Email', $strMsgHTML, array(array($user->email, $user->username)));

                    // Notice Sent mail validate for change password
                    $this->setRedirectOptions(array(
                        "timeout" => 5,
                        "title" => UserModule::t('Change Email - Step 1'),
                        "message" => UserModule::t('We have sent you a confirmation email to the email change. Please check and verify it!'),
                    ));
                    $this->redirect('/user/profile');
                }
            }

            // Render form requirement change email
            $this->render('changeemailstep1');
        } else { // Bước 2: Đổi email
            // Validate code change email
            $strChangeEmailCode = $_GET['code'];

			$user = User::model()->notsafe()->findByPk(Yii::app()->user->id);
            // Check Code
            if ($strChangeEmailCode == $user->activkey) {
                $model = new ChangeEmailForm;

                // Submit form
                if (isset($_POST['ChangeEmailForm'])) {
                    $model->attributes = $_POST['ChangeEmailForm'];

                    $user = User::model()->notsafe()->findByPk(Yii::app()->user->id);
                    //$model->user = $user;
                    // Validate info
                    if ($model->validate()) {
                        // Change email
                        $user->email = $model->email;

						// Delete old Code change email
						$user->activkey = $user->createCodeActivation();
                        // Save new email to DB
                        if ($user->save()) {
                           /**
                             * @todo Change message email
                             */
                            $strMsgHTML = "Change Email Success";
                            Yii::import('application.extensions.phpmailer.HMailHelper');
                            HMailHelper::Send('Change Email', $strMsgHTML, array(array($user->email, $user->username)));

                            // Notice Change Email success
                            $this->setRedirectOptions(array(
                                "title" => UserModule::t('Change Email Success'),
                                "message" => UserModule::t('The change email was successful!'),
                            ));
                            $this->redirect('/user/profile');
                        }
                    }
                }

                // Render form change email
                $this->render('changeemailstep2', array('model' => $model));
                Yii::app()->end();
            }

            // Notice activation failure
            $this->setRedirectOptions(array(
                "title" => UserModule::t('Change Email Failure'),
                "message" => UserModule::t('Incorrect change email URL!'),
            ));
            $this->redirect("/");
        }
    }

}