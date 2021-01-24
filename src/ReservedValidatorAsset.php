<?php

namespace wdmg\validators;

use yii\web\AssetBundle;

/**
 * Reserved Validation asset bundle.
 */
class ReservedValidatorAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\validators\ValidationAsset'
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->sourcePath = __DIR__ . '/assets';
        $this->js = YII_DEBUG ? [
            'js/reserved-validator.js'
        ] : [
            'js/reserved-validator.min.js'
        ];
    }
}