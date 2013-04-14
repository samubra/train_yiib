<?php

Yii::import('application.models._base.BaseItem');

class Item extends BaseItem
{
	const TYPE_INDUSTRY='industry';
	const TYPE_BUSINESS='business';
	const TYPE_OPERATION='operation';
	const TYPE_PROFESSIONAL='professional';
	const TYPE_CATEGORY='category';
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	public function rules() {
		return array(
				array('name, slug', 'length', 'max'=>200),
				array('type', 'length', 'max'=>32),
				array('type', 'in','range' => self::getConstants('TYPE_',__CLASS__)),
				array('uid, parent, name, slug, type', 'default', 'setOnEmpty' => true, 'value' => null),
				array('id, uid, parent, name, slug, type', 'safe', 'on'=>'search'),
		);
	}
	
	public static function getStatuses() {
		return self::getConstants('STATUS_',__CLASS__);
	}
	public static function getTypes() {
		return self::getConstants('TYPE_',__CLASS__);
	}
	public function relations() {
		return array(
				'parent'=>array(self::BELONGS_TO,'Item','parent'),
				'user'=>array(self::BELONGS_TO,'User','uid')
		);
	}

	public function pivotModels() {
		return array(
		);
	}


	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('uid', $this->uid, true);
		$criteria->compare('parent', $this->parent, true);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('slug', $this->slug, true);
		$criteria->compare('type', $this->type, true);

		return new CActiveDataProvider($this, array(
				'criteria' => $criteria,
		));
	}
}