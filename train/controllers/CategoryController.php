<?php

class CategoryController extends GxController {

    public function filters() {
        return array(
            'accessControl',
            'postOnly + create,update',
            'ajaxOnly + view'
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
        if (Yii::app()->request->isAjaxRequest) {
            $this->renderPartialWithHisOwnClientScript('ajaxview', array(
                'model' => $this->loadModel($id, 'Category'),
            ));
        } else {
            user()->setFlash('info', t('app|this is ajax request only!'));
            $this->redirect(array('index'));
        }
    }

    public function actionCreate() {
        if (isset($_POST['Category'])) {
            $model = new Category;
            $model->setAttributes($_POST['Category']);

            if ($model->save()) {
                if (Yii::app()->getRequest()->getIsAjaxRequest())
                    Yii::app()->end();
                else {
                    user()->setFlash('success', t('app|Data save success!'));
                    $this->redirect(array('index'));
                }
            }
        } else {
            user()->setFlash('info', t('app|this is post request only!'));
            $this->redirect(array('index'));
        }
    }

    public function actionUpdate($id) {
        if (isset($_POST['Category'])) {
            $model = $this->loadModel($id, 'Category');
            $model->setAttributes($_POST['Category']);

            if ($model->save()) {
                user()->setFlash('success', t('app|Data save success!'));
                $this->redirect(array('index'));
            }
        } else {
            user()->setFlash('info', t('app|this is post request only!'));
            $this->redirect(array('index'));
        }
    }

    public function actionDelete($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'Category')->delete();
            echo $this->renderPartialWithHisOwnClientScript('successview', null, true);
        }
        else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex() {
        $this->headTitle = '分类管理';
        $this->headInfo = '分类列表  添加分类';
        $this->layout = 'column1';
        $this->render('index');
    }

}