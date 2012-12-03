<?php

class LoginController extends HController
{
	public function actionIndex()
	{
		// Kiểm tra nếu đăng nhập rồi chuyển trang
		if(!Yii::app()->user->isGuest)
		{
			if (strpos(Yii::app()->user->returnUrl, '/index.php') !== false)
					$this->redirect("/user/profile");
				else
					$this->redirect(Yii::app()->user->returnUrl);
		}
		
		$model = new LoginForm();
		
		// if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
		
		// collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
            	$this->setRedirectOptions(array(
					"title" => UserModule::t('Login Success'),
					"message" => UserModule::t('The login was successful!'),
				));
				
                if (strpos(Yii::app()->user->returnUrl, '/index.php') !== false)
                    $this->redirect("/user/profile");
                else
                    $this->redirect(Yii::app()->user->returnUrl);
            }
        }
		
		$this->render('index', array('model' => $model));
	}
}