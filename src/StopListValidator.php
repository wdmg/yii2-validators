<?php

namespace wdmg\validators;

/**
 * Yii2 Stop list validator
 *
 * @category        Validators
 * @version         1.0.5
 * @author          Alexsander Vyshnyvetskyy <alex.vyshnyvetskyy@gmail.com>
 * @link            https://github.com/wdmg/yii2-validators
 * @copyright       Copyright (c) 2019 W.D.M.Group, Ukraine
 * @license         https://opensource.org/licenses/MIT Massachusetts Institute of Technology (MIT) License
 *
 */

use Yii;
use yii\base\InvalidConfigException;
use yii\validators\Validator;
use yii\validators\ValidationAsset;
use yii\helpers\Json;

class StopListValidator extends Validator
{

    /**
     * @var array, list of stop words
     */
    public $stoplist;

    /**
     * @var bool, strict array search
     */
    public $strict = false;

    /**
     * @var string, error message when the value is not a valid
     */
    public $message;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        if (is_null($this->stoplist))
            throw new InvalidConfigException('Stoplist should be defined');

        if (!count($this->stoplist))
            throw new InvalidConfigException('Stoplist must contain at least one element');

        if (!is_array($this->stoplist))
            throw new InvalidConfigException('Stoplist should be an array');

        if (is_null($this->message))
            $this->message = Yii::t('app', 'You can not use this value `{value}` for field `{attribute}`');

    }

    /**
     * {@inheritdoc}
     */
    protected function validateValue($value)
    {
        if (!is_string($value)) {
            $valid = false;
        } elseif (in_array($value, $this->stoplist, $this->strict) || in_array(preg_replace('/\d+/u', '', $value), $this->stoplist, $this->strict)) {
            $valid = false;
        } else {
            $valid = true;
        }

        return $valid ? null : [$this->message, []];
    }

    /**
     * {@inheritdoc}
     */
    public function clientValidateAttribute($model, $attribute, $view)
    {
        ValidationAsset::register($view);
        $options = $this->getClientOptions($model, $attribute);
        return 'yii.validation.stoplist(value, messages, ' . Json::htmlEncode($options) . ');';
    }

    /**
     * {@inheritdoc}
     */
    public function getClientOptions($model, $attribute)
    {
        $options = [
            'stoplist' => $this->stoplist,
            'message' => $this->formatMessage($this->message, [
                'attribute' => $model->getAttributeLabel($attribute),
            ]),
        ];

        return $options;
    }
}
