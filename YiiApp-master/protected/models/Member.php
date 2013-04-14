<?php

Yii::import('application.models._base.BaseMember');

class Member extends BaseMember
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}