<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\dashboard\controllers;

use common\models\News;
use common\widgets\Alert;
use common\widgets\Nav;
use modules\dashboard\Controller;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class NewsController extends Controller
{
    public function init()
    {
        parent::init();
        Nav::setMenu('main-sidebar', [
            [
                'label' => '添加新闻',
                'url' => ['news/create'],
            ],
            ['label' => News::statusLabel(News::STATUS_PROPOSED),
                'url' => ['news/index', 'status' => News::STATUS_PROPOSED],
            ],
            [
                'label' => News::statusLabel(News::STATUS_REJECTED),
                'url' => ['news/index', 'status' => News::STATUS_REJECTED],
            ],
            [
                'label' => News::statusLabel(News::STATUS_PUBLISHED),
                'url' => ['news/index', 'status' => News::STATUS_PUBLISHED],
            ]
        ]);
    }

    public function accessRules()
    {
        $rules[] = [
            'allow' => true,
            'roles' => ['manageNews']
        ];
        return $rules;
    }

    public function actionIndex($status = News::STATUS_PUBLISHED)
    {
        $query = News::find()->orderBy('createdAt DESC');
        $query->andWhere(['status' => $status]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 10],
        ]);

        return $this->render('index', [
            'status' => $status,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News([
            'status' => News::STATUS_PUBLISHED
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->userId = Yii::$app->user->id;
            if ($model->save(false)) {
                Alert::set('success', '添加成功');
                return $this->redirect(['update', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Alert::set('success', '保存成功');
            return $this->refresh();
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}