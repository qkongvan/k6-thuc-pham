<?php

class ActivationController extends HController
{
	public function actionActivate()
	{
		// Validate Code activation
        if(isset($_GET['activekey']) && isset($_GET['email']))
        {
            $strActivateCode = $_GET['activekey'];
            $strEmail = $_GET['email'];
            $user = User::model()->notsafe()->findByAttributes(array('email'=>$strEmail));
            if (isset($user)) {
                if ($user->status == User::STATUS_ACTIVE)
                {
                    $this->setRedirectOptions(array(
                        "title"     =>  UserModule::t( 'Activation Was Successful'),
                        "message"   =>  UserModule::t( 'This account has been activated!'),
                    ));
                    $this->redirect("/user/profile");
                }
                
                // Check Code
                if ($user->activkey == $strActivateCode)
                {
                    // Active user
                    $user->status = User::STATUS_ACTIVE;
                    // Delete active code
                    $user->activkey = $user->createCodeActivation();
                    $user->save();
                    
                    // Change role to Member
                    //Rights::revoke(Yii::app()->params['roles']['AWAITING'], $user->id);
                    //Rights::assign(Yii::app()->params['roles']['MEMBER'], $user->id);
                    
                    /**
                     * @todo Change message email
                     */
                    $strMsgHTML = "Activation success";
                    Yii::import('application.extensions.phpmailer.HMailHelper');
                    HMailHelper::Send('Activation Account', $strMsgHTML, array(array($user->email, $user->username)));
                    
                    // Notice activation success
                    $this->setRedirectOptions(array(
                        "title"     =>  UserModule::t('Activation Success'),
                        "message"   =>  UserModule::t('You account is activated!'),
                    ));
                    $this->redirect("/user/profile");
                } else {
              		
                    // Notice activation failure
                    $this->setRedirectOptions(array(
                        "title"     =>  UserModule::t('Activation Email Failure'),
                        "message"   =>  UserModule::t('Incorrect activation URL or Activation period has expired!'),
                    ));
                    $this->redirect("/user/profile");
                }
            }
        }
        
        // Notice activation failure
        $this->setRedirectOptions(array(
            "title"     =>  UserModule::t('Activation Email Failure'),
            "message"   =>  UserModule::t('Incorrect activation URL!'),
        ));
        $this->redirect("/user/profile");
	}
}