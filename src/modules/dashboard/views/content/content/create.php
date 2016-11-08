<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */


/* @var $this yii\web\View */
/* @var $model common\models\ContentPool */

$this->title = '新增内容';
$this->params['breadcrumbs'][] = ['label' => '内容池', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-pool-create">
    <div class="box">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>