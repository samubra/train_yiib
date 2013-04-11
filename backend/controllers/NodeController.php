<?php

class NodeController extends GxController {

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('minicreate', 'create', 'update', 'admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'Node'),
        ));
    }

    public function actionCreate() {
        $this->headTitle = '试题管理';
        $this->headInfo = '添加试题';
        $this->layout = 'column1';
        Yii::import('ext.multimodelform.MultiModelForm');
        $model = new Node;
        $category = new Category;
        $item = new Item;
        //  $this->performAjaxValidation($model, 'node-form');
        $validatedItem = array(); //ensure an empty array
        if (isset($_POST['Node'])) {
            $model->setAttributes($_POST['Node']);
            //$_POST['Node']['tag']='1';
            $relatedData = array(
                'tag' => $_POST['Node']['tag'] === '' ? null : $_POST['Node']['tag'],
            );
            if (MultiModelForm::validate($item, $validatedItem) && $model->save()) {
                $masterValues = array('nid' => $model->id);
                if (MultiModelForm::save($item, $validatedItem, $deleteItem, $masterValues)) {

                    $this->redirect(array('view', 'id' => $model->id));
                }
            }
        }

        $this->render('create', array('model' => $model, 'category' => $category, 'item' => $item, 'validatedItem' => $validatedItem,));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id, 'Node');

        $this->performAjaxValidation($model, 'node-form');

        if (isset($_POST['Node'])) {
            $model->setAttributes($_POST['Node']);
            $relatedData = array(
                'tag' => $_POST['Node']['tag'] === '' ? null : $_POST['Node']['tag'],
            );

            if ($model->saveWithRelated($relatedData)) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'Node')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        }
        else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Node');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new Node('search');
        $model->unsetAttributes();

        if (isset($_GET['Node']))
            $model->setAttributes($_GET['Node']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

}