<?php
/*
 * 所有ActiveRecord模型的基类,抽象 @author samubra
 */
abstract class BaseActiveRecord extends GxActiveRecord {
	
	/*
	 * 设置命名空间
	 */
	public function scopes() {
		// 设置uid条件
		return array (
				//用户个人的记录
				'own' => array (
						'condition' => 'uid=' . ( int ) Yii::app ()->user->id 
				),
		);
	}
	/*
	 * 查询特定用户的记录
	*/
	public function user($user = null) {
		$user=$user?$user:Yii::app()->user->id;
		$this->getDbCriteria ()->mergeWith ( array (
				'condition' => 'uid=' . $user
		) );
		return $this;
	}
	/*
	 * 设置status为1的记录
	 */
	public function status($status = '1') {
		$this->getDbCriteria ()->mergeWith ( array (
				'condition' => 'status=' . $status 
		) );
		return $this;
	}
	/*
	 * 设置public为1的记录
	*/
	public function published($public= '1') {
		$this->getDbCriteria ()->mergeWith ( array (
				'condition' => 'public=' . $public
		) );
		return $this;
	}
	/*
	 * 验证前所调用的方法
	 */
	protected function beforeValidate() {
		$time = new CDbExpression ( 'NOW()' );//获取当前时间
		$userid=user()->id;
		if ($this->isNewRecord) {//新纪录
			if ($this->hasAttribute ( 'create_time' )) {
				$this->create_time = $time;
			}
			if ($this->hasAttribute ( 'uid' )) {
				$this->uid = Yii::app ()->user->id;
			}
			if($this->hasAttribute('create_user')){
				$this->create_user=$userid;
			}
		}
		if ($this->hasAttribute ( 'update_time' )) {
			$this->update_time = $time;
		}
		if($this->hasAttribute('update_user')){
				$this->update_user=$userid;
			}
		
		return parent::beforeValidate ();
	}
}

?>