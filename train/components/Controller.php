<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column2';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	public $headTitle='';
	public $headInfo='';
	public $blockIcon='isw-grid';
	public $blockTitle='';

	/**
	 * 使用rights权限管理器
	 *
	public function filters() {
		return array (
				'rights' 
		);
	}
	/**
	 * 设置不需要验证的action
	 * @return string the actions that are always allowed separated by commas.
	 *
	public function allowedActions() {
		return 'login,error,activation,recovery,registration,captcha';
	}*/
	/**
	 *
	 * @param string $view 请求的视图文件
	 * @param array $data 传递的参数
	 * @param boolen $return 是否直接输出，默认为false表示不直接显示返回为需要显示的字符串
	 * @return max
	 */
	public function renderPartialWithHisOwnClientScript($view,$data=null, $return=false)
	{
	
		$mainClientScript=Yii::app()->clientScript;
		Yii::app()->setComponent('clientScript', new ZClientScript);
		$output=$this->renderPartial($view, $data,  true);
		$output.=Yii::app()->clientScript->renderOnRequest();
		Yii::app()->setComponent('clientScript', $mainClientScript);
	
		if ($return)
			return $output;
		else
			echo $output;
	}
}
class ZClientScript extends CClientScript
{
	/**
	 * Inserts the scripts at the beginning of the body section.
	 * @param string the output to be inserted with scripts.
	 */
	public function renderOnRequest()
	{
		$html='';
		foreach($this->scriptFiles as $scriptFiles)
		{
			foreach($scriptFiles as $scriptFile)
				$html.=CHtml::scriptFile($scriptFile)."\n";
		}
		foreach($this->scripts as $script)
			$html.=CHtml::script(implode("\n",$script))."\n";

		if($html!=='')
			return $html;
	}

}