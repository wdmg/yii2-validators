<?php

namespace wdmg\validators;

use Yii;
use yii\base\InvalidConfigException;
use yii\validators\Validator;

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
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        if ($this->stoplist === null)
            throw new InvalidConfigException('Stoplist should be defined');

        if (!count($this->stoplist))
            throw new InvalidConfigException('Stoplist must contain at least one element');

        if (!is_array($this->stoplist))
            throw new InvalidConfigException('Stoplist should be an array');

        if ($this->message === null)
            $this->message = \Yii::t('yii',
                'You can not use this value `{value}` for field `{attribute}`');

    }

    /**
     * Check if the value in the list of banned words
     * @param mixed $value
     * @return array
     */
    public function validateValue($value)
    {
        if ($value === null)
            throw new InvalidConfigException('Value must be set.');

        if (in_array($value, $this->stoplist, $this->strict) || in_array(preg_replace('/\d+/u', '', $value), $this->stoplist, $this->strict)) {
            return [
                $this->message,
            ];
        }

        return true;
    }
}