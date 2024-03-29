<?php

Yii::import('application.models._base.BaseNode');

class Node extends BaseNode {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function relations() {
        return array(
            'user' => array(
                self::BELONGS_TO,
                'User',
                'uid'
            ),
            'category' => array(
                self::BELONGS_TO,
                'Category',
                'cid'
            ),
            'item'=>array(
            self::HAS_MANY,
                'Item',
                'nid'
            ),
            'tag'=>array(
            self::MANY_MANY,
                'Tag',
                'train_node_tag_relationship(nid,tid)'
            )
        );
    }

    public function behaviors() {
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'created',
                'updateAttribute' => 'modified',
            )
        );
    }

    public function beforeValidate() {
        if ($this->isNewRecord) {
            if ($this->hasAttribute('uid')) {
                $this->uid = user()->id;
            }
        }
        return parent::beforeValidate();
    }

}