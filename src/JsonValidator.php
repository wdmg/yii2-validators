<?php

namespace wdmg\validators;

/**
 * Yii2 JSON Validator
 *
 * @category        Validators
 * @version         1.0.6
 * @author          Alexsander Vyshnyvetskyy <alex.vyshnyvetskyy@gmail.com>
 * @link            https://github.com/wdmg/yii2-validators
 * @copyright       Copyright (c) 2019 - 2021 W.D.M.Group, Ukraine
 * @license         https://opensource.org/licenses/MIT Massachusetts Institute of Technology (MIT) License
 *
 */

use Yii;
use yii\validators\Validator;


class JsonValidator extends Validator
{

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

        if (is_null($this->message))
            $this->message = Yii::t('app', 'The value of field `{attribute}` must be a valid JSON: {error}.');

    }

    public static function isValid($value) {
        json_decode($value);
        if (json_last_error())
            return false;

        return true;
    }

    /**
     * {@inheritdoc}
     */
    protected function validateValue($value)
    {

        if (!self::isValid($value)) {
            return [
                $this->message,
                [
                    'error' => json_last_error_msg()
                ]
            ];
        }

        return null;
    }

}