<?php

class RegisterController extends HController
{
	public function actions() {
		return (isset($_POST['ajax']) && $_POST['ajax'] === 'registration-form') ? array() : array(
			'captcha' => array(
				'class' => 'CCaptchaAction',
				'backColor' => 0xFFFFFF,
			),
		);
	}
	
	public function actionIndex()
	{
		// Kiểm tra nếu đăng nhập rồi chuyển trang
		if(!Yii::app()->user->isGuest)
			$this->redirect("/user/profile");
		
		$model = new RegistrationForm;
		
		/*
		 * Nếu dữ liệu được post lên để validate (thông thường khi ta lost focus một input nào đó thì hệ thống
		 * sẽ sử dụng ajax), khi đó ta tiến hành kiểm tra dữ liệu và nếu có lỗi thì gửi thông báo lỗi về
		 * 
		 */
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'registration-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		
		// Submit form
		if (isset($_POST['RegistrationForm'])) {
			$model->attributes = $_POST['RegistrationForm'];

			// Create password
			$model->encryptPassword($model->textPassword);

			// Validate Form
			if ($model->validate()) {
				// Create code activation
				$codeActivation = $model->createCodeActivation();
	
				// Create user
				if ($model->save()) {
					// Assign user to Awaiting role
					//Rights::assign(Yii::app()->params['roles']['AWAITING'], $model->id);

					if ($codeActivation != '') {
						/**
						 * @todo Change message email
						 */
						$strActivationUrl = $this->createAbsoluteUrl('/user/activation/activate', array("activekey" => $codeActivation, "email" => $model->email));

						$strMsgHTML = "<a href='{$strActivationUrl}'>{$strActivationUrl}</a>";
						Yii::import('application.extensions.phpmailer.HMailHelper');
						HMailHelper::Send('Activation Account', $strMsgHTML, array(array($model->email, $model->firstname)));
					} else {
						//BUG: Không thể tạo code
					}

					$this->setRedirectOptions(array(
						"title" => UserModule::t( 'Registration Success'),
						"message" => UserModule::t( 'The registration was successful!'),
					));
					$this->redirect('/user/login');
				}
			}
		}

		$this->render('index', array('model' => $model));
	}
}