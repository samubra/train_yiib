<?php 
class WebUser extends CWebUser
{
	private $_userTable = array
    (
    		0=>'普通用户',
    		1=>'编辑',
    		8=>'管理员',
    		9=>'超级管理员'
    );

	protected $_model;

	function isAdmin()
	{
		//Access this via Yii::app()->user->isAdmin()

		return $this->level == 8;
	}

	public function isSuperuser()
	{
		//Access this via Yii::app()->user->isSuperuser()

		return $this->level == 9;
	}

	public function canAccess($minimumLevel)
	{
		//Access this via Yii::app()->user->canAccess(9)

		return $this->level >= $minimumLevel;
	}

	public function getRoleName()
	{
		//Access this via Yii::app()->user->roleName()

		return $this->getUserLabel($this->level);
	}

	public function getUserLabel($level)
	{
		//Use this for example as a column in CGridView.columns:
		//
		//array('value'=>'Yii::app()->user->getUserLabel($data->level)'),

		return $this->_userTable[$level];
	}

	public function getUserLevelList()
	{
		//Access this via Yii::app()->user->getUserLevelList()

		return $this->_userTable;
	}
}