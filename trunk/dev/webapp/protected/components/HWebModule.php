<?php
/**
 * HWebModule is the customized base CWebModule class.
 * All module classes for this application should extend from this base class.
 */
abstract class HWebModule extends CWebModule
{
	/**
	* Translates a message to the specified language.
	* Wrapper class for setting the category correctly.
	* @param string $category message category.
	* @param string $message the original message.
	* @param array $params parameters to be applied to the message using <code>strtr</code>.
	* @param string $source which message source application component to use.
	* @param string $language the target language.
	* @return string the translated message.
	*/
	public static function t($message='', $params=array(), $category='default', $source=null, $language=null)
	{
		return $message; // HOT FIX
		return Yii::t(get_called_class().'.'.$category, $message, $params, $source, $language);
	}
}