<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\News;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\web\View;
use yiizh\redactor\Redactor;

/**
 * @var $this View
 * @var $model News
 */

$this->title = '分享';

$this->params['breadcrumbs'][] = ['label' => '资讯', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$projectIdInputId = Html::getInputId($model, 'projectId');
?>
<div class="news-suggest">
    <div class="box">
        <div class="box-body">
            <?php $form = ActiveForm::begin(['id' => 'news-add']) ?>

            <?= $form->field($model, 'type')->dropDownList(News::getTypeItems(), [
                'prompt' => '-- 请选择 --'
            ]) ?>

            <?= Html::activeHiddenInput($model, 'projectId') ?>
            <?= $form->field($model, 'projectName')->widget(AutoComplete::className(), [
                'options' => [
                    'class' => 'form-control'
                ],
                'clientOptions' => [
                    'source' => Url::to(['/project/project/search']),
                    'select' => new JsExpression(<<<JS
function ( event, ui ){
    $('#{$projectIdInputId}').val(ui.item.id);
}
JS
                    ),
                ]
            ]) ?>

            <?= $form->field($model, 'link') ?>

            <?= $form->field($model, 'title') ?>

            <?= $form->field($model, 'content')->widget(Redactor::className(), [

            ]) ?>

            <div class="form-group">
                <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>
