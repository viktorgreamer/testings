<?php

namespace app\modules\webdriver;

/**
 * webdriver module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\webdriver\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {

        $this->layout = "@app/modules/webdriver/views/layouts/main.php";
        parent::init();

        // custom initialization code goes here
    }
}
