<?php

class MetasController extends GxController {

    public function filters() {
        return array(
            'accessControl'
        );
    }

    public function accessRules() {
        return array(
            array(
                'allow',
                'actions' => array(
                    'index',
                    'view',
                    'create',
                    'category'
                ),
                'users' => array(
                    '@'
                )
            ),
            array(
                'allow',
                'actions' => array(
                    'minicreate',
                    'update',
                    'admin',
                    'delete'
                ),
                'users' => array(
                    'admin'
                )
            ),
            array(
                'deny',
                'users' => array(
                    '*'
                )
            )
        );
    }

    public function actionView($id) {
        $this->renderPartialWithHisOwnClientScript('view', array(
            'model' => $this->loadModel($id, 'Metas')
        ));
    }

    public function actionCreate($id = null, $new = false) {
        $model = new Metas ();
        $parent = false;
        if (is_null($id) && $new == true) {
            if (isset($_POST['Metas']) && !app()->getRequest()->getIsAjaxRequest()) {
                $this->saveNode($_POST['Metas'], true);
            }
        } elseif (!is_null($id) && $new == false) {
            $parent = (int) $id;
            if (isset($_POST['Metas']) && !app()->getRequest()->getIsAjaxRequest()) {
                $this->saveNode($_POST['Metas']);
            }
        }


        $this->renderPartialWithHisOwnClientScript('_form', array(
            'model' => $model,
            'parent' => $parent
                ), false, true);
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id, 'Metas');


        if (isset($_POST ['Metas'])) {
            $model->setAttributes($_POST ['Metas']);
            $relatedData = array(
                    //'node' => !isset($_POST['Metas']['node'])? null : $_POST['Metas']['node'],
                    )
            ;

            if ($model->saveWithRelated($relatedData)) {
                $this->redirect(array(
                    'view',
                    'id' => $model->id
                ));
            }
        }

        $this->renderPartialWithHisOwnClientScript('_form', array(
            'model' => $model,
            'parent' => false
                ), false, true);
    }

    public function actionDelete($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'Metas')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array(
                    'admin'
                ));
        }
        else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex() {
        $this->headTitle = '分类管理';
        $this->headInfo = "科目、章节、单元管理";
        $this->layout = "column1";
        $tagModel = Metas::model()->findAll('uid=:uid AND type=:type', array(':uid' => user()->id, ':type' => 'tag'));
        $model = Metas::model()->roots()->findAll(array(
            'order' => 'lft',
            'condition' => 'uid=:uid AND type=:type',
            'params' => array(
                ':uid' => user()->id,
                ':type' => 'category'
            )
                ));
        $dataList = array();
        foreach ($model as $data) {
            $dataList[] = $data;
            $metas = Metas::model()->findByPk($data->id, 'uid=:uid AND type=:type', array(
                ':uid' => user()->id,
                ':type' => 'category',
                    )
            );
            $children = $metas->children()->findAll(array(
                'order' => 'lft',
                'condition' => 'uid=:uid AND type=:type',
                'params' => array(
                    ':uid' => user()->id,
                    ':type' => 'category'
                )
            ));
            //dump($children);
            if ($children) {
                foreach ($children as $child) {
                    $dataList[] = $child;
                }
            }
            //dump($data->id);
        }


        $categorymodel = new CArrayDataProvider($dataList);
        $this->render('index', array(
            'categoryModel' => $categorymodel,
            'tagModel' => $tagModel
        ));
    }

    /*
     * public function actionIndex($type = 'category') { $this->headTitle = '分类管理'; $this->headInfo = "科目、章节、单元、标签管理"; $this->layout = "column1"; $metasModel = new Metas ( 'category' ); if (isset ( $_GET ['id'] )) { $metasModel = $this->loadModel ( ( int ) $_GET ['id'], 'Metas' ); if (! in_array ( $metasModel->uid, array ( '1', user ()->id ) )) throw CHttpException ( 403, '你没有权限处理该数据！' ); } if (isset ( $_POST ['Metas'] ) && $type == 'category') { $metasModel->setAttributes ( $_POST ['Metas'] ); if ($metasModel->saveNode()) { if (Yii::app ()->getRequest ()->getIsAjaxRequest ()) { Yii::app ()->end (); } else { user ()->setFlash ( 'success', '分类保存成功！' ); $this->redirect ( array ( '/metas/index', 'type' => $type ) ); } } } /*$criteria = new CDbCriteria (); $criteria->order = '`lft` ASC'; $criteria->limit = - 1; $criteria->addCondition ( 'uid=' . user ()->id ); $criteria->addCondition ( 'type=:type' ); $criteria->params [':type'] = $type; $model = new CActiveDataProvider ( 'Metas', array ( 'criteria' => $criteria, 'pagination' => array ( 'pageSize' => 1000 ) ) );
     */
    /* $metass=Metas::model()->findByPk(1);
      $semetass=Metas::model()->findByPk(2);
      $semetass->moveAsLast($metass); */
    /* $model=new CArrayDataProvider(Metas::model()->findAll(array('order'=>'lft')));



      $this->render ('index', array (
      'model' => $model,
      'metasModel' => $metasModel,
      'type' => $type
     * 	) );
      } */

    public function actionAdmin() {
        $model = new Metas('search');
        $model->unsetAttributes();

        if (isset($_GET ['Metas']))
            $model->setAttributes($_GET ['Metas']);

        $this->render('admin', array(
            'model' => $model
        ));
    }

    protected function saveNode($data, $root = null) {
        $model = new Metas ();

        $model->setAttributes($data);
        $model->type = 'category';
        if (!is_null($root) && $root == true) {
            $model->saveNode();
        } else {

            $root = $this->loadModel($data['parent'], 'Metas');
            $model->appendTo($root);
        }
        user()->setFlash('success', '分类保存成功');
        $this->redirect(array('index'));
    }

    public function getNameText($data, $row) {
        $beforeString = str_repeat("-", ($data->level - 1) * 3); //&nbsp;
        $nameText = CHtml::link($data->name, url('/node/index', array(
                    'mid' => $data->id
                )));
        echo $beforeString . $nameText;
    }

    public function actionMoveDown($id) {
        if (!$this->loadModel($id, 'Metas')->moveDown()) {
            throw new CHttpException(400, strip_tags(CHtml::errorSummary($this->loadModel($id, 'Metas'))));
        }
    }

    public function actionMoveUp($id) {
        if (!$this->loadModel($id, 'Metas')->moveUp()) {
            throw new CHttpException(400, strip_tags(CHtml::errorSummary($this->loadModel($id, 'Metas'))));
        }
    }

}