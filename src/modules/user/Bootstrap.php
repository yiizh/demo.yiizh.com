<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\user;

use common\components\AddUrlRulesInterface;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface, AddUrlRulesInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        $app->setModule('user', [
            'class' => Module::className(),
        ]);
    }

    /**
     * @inheritDoc
     */
    public function addUrlRulesTo($urlManager)
    {
        $urlManager->addRules([
            '/user/<userId:\d+>' => '/user/default/index',
        ]);
    }


}