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
				'actions'=>array('index', 'view'),
				'users'=>array('@'),
				),
			array('allow', 
				'actions'=>array('minicreate', 'create', 'update', 'admin', 'delete'),
				'users'=>array('admin'),
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Node'),
		));
	}

	public function actionCreate() {
		$model = new Node;

		$this->performAjaxValidation($model, 'node-form');

		if (isset($_POST['Node'])) {
			$model->setAttributes($_POST['Node']);
			$relatedData = array(
				'metas' => $_POST['Node']['metas'] === '' ? null : $_POST['Node']['metas'],
				);

			if ($model->saveWithRelated($relatedData)) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Node');

		$this->performAjaxValidation($model, 'node-form');

		if (isset($_POST['Node'])) {
			$model->setAttributes($_POST['Node']);
			$relatedData = array(
				'metas' => $_POST['Node']['metas'] === '' ? null : $_POST['Node']['metas'],
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
		} else
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