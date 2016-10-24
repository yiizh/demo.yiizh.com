<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\News;
use common\models\User;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\web\View;

/**
 * @var $this View
 * @var $model News
 * @var $user User
 */
$user = $model->user;
$formatter = Yii::$app->formatter;
?>
<div class="news-item">
        <h3 class="news-item-title"><?= Html::a($model->title, ['/news/view', 'id' => $model->id]) ?></h3>
        <p class="news-item-meta">
            <time class="text-muted"><?= $formatter->asRelativeTime($model->createdAt) ?></time>
            <a href="<?= $user->getUrl() ?>">@<?= $user->name ?></a>
        </p>
        <p class="news-item-summary"><?= HtmlPurifier::process($model->summary) ?></p>
</div>