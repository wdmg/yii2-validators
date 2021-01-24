<?php

namespace wdmg\validators;

/**
 * Yii2 Serialized Data Validator
 *
 * @category        Validators
 * @version         1.0.7
 * @author          Alexsander Vyshnyvetskyy <alex.vyshnyvetskyy@gmail.com>
 * @link            https://github.com/wdmg/yii2-validators
 * @copyright       Copyright (c) 2019 - 2021 W.D.M.Group, Ukraine
 * @license         https://opensource.org/licenses/MIT Massachusetts Institute of Technology (MIT) License
 *
 */

use Yii;
use yii\validators\Validator;


class SerialValidator extends Validator
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
            $this->message = Yii::t('app', 'The value of field `{attribute}` must be a valid serialized data: {error}.');

    }

    public static function isValid($value) {

        if (@unserialize($value) === false) {
            return false;
        }

        return true;
    }

    public function validateValue($value) {

        if (!self::isValid($value)) {
            return [
                $this->message,
                [
                    'error' => 'unserialized data'
                ]
            ];
        }

        return null;
    }

}