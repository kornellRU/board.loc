<?php

namespace app\modules\profile;

/**
 * profile module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\profile\controllers';

    public $userPhotoUrl = '';

    public $userPhotoPath = '';

    public $customViews = [];

    public $customMailViews = [];

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
