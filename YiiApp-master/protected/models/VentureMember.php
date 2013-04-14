<?php

Yii::import('application.models._base.BaseVentureMember');

class VentureMember extends BaseVentureMember
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}