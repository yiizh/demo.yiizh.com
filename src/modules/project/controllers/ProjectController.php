<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\project\controllers;


use common\models\Project;
use modules\project\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class ProjectController extends Controller
{
    public function accessRules()
    {
        $rules = parent::accessRules();

        $rules[] = [
            'allow' => true,
            'actions' => ['index', 'view'],
        ];

        $rules[] = [
            'allow' => true,
            'actions' => ['suggest'],
            'roles' => ['@']
        ];


        return $rules;
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Project::find()->active()->orderBy('updatedAt DESC'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->updateCounters(['viewCount' => 1]);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::find()->active()->andWhere(['id' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException();
        }
    }
}