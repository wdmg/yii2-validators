<?php

namespace wdmg\validators;

/**
 * Yii2 Emails Validator
 *
 * @category        Validators
 * @version         1.0.5
 * @author          Alexsander Vyshnyvetskyy <alex.vyshnyvetskyy@gmail.com>
 * @link            https://github.com/wdmg/yii2-validators
 * @copyright       Copyright (c) 2019 - 2020 W.D.M.Group, Ukraine
 * @license         https://opensource.org/licenses/MIT Massachusetts Institute of Technology (MIT) License
 *
 */

use Yii;
use yii\base\InvalidConfigException;
use yii\validators\Validator;
use yii\validators\EmailValidator;


class EmailsValidator extends Validator
{

    /**
     * @var string, see yii\validators\EmailValidator::$pattern
     */
    public $pattern;

    /**
     * @var string, see yii\validators\EmailValidator::$fullPattern
     */
    public $fullPattern;

    /**
     * @var bool, see yii\validators\EmailValidator::$allowName
     */
    public $allowName;

    /**
     * @var bool, see yii\validators\EmailValidator::$checkDNS
     */
    public $checkDNS;

    /**
     * @var bool, see yii\validators\EmailValidator::$enableIDN
     */
    public $enableIDN;

    /**
     * @var string, error message when the value is not a valid
     */
    public $message;

    /**
     * @var string, error message when the value is not a valid
     */
    public $delimiter = ',';

    /**
     * @var object, yii\validators\EmailValidator instance
     */
    private $_validator;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        if (is_null($this->delimiter))
            throw new InvalidConfigException('Delimiter should be defined');

        $this->_validator = new EmailValidator();

        if (!is_null($this->pattern) && !empty($this->pattern))
            $this->_validator->pattern = $this->pattern;

        if (!is_null($this->fullPattern) && !empty($this->fullPattern))
            $this->_validator->fullPattern = $this->fullPattern;

        if (!is_null($this->allowName))
            $this->_validator->allowName = boolval($this->allowName);

        if (!is_null($this->checkDNS))
            $this->_validator->checkDNS = boolval($this->checkDNS);

        if (!is_null($this->enableIDN))
            $this->_validator->enableIDN = boolval($this->enableIDN);

        if (is_null($this->message))
            $this->message = Yii::t('app', 'One or more value of field `{attribute}` must be a valid email address.');

    }

    /**
     * {@inheritdoc}
     */
    protected function validateValue($value)
    {
        $error = false;
        if (is_array($value)) {
            foreach ($value as $email) {
                if (!$error && !($this->_validator->validate(trim($email)))) {
                    $error = true;
                }
            }
        } else if (is_string($value)) {
            $data = explode($this->delimiter, $value);
            if ($data) {
                foreach ($data as $email) {
                    if (!$error && !($this->_validator->validate(trim($email)))) {
                        $error = true;
                    }
                }
            } else {
                if (!$error && !($this->_validator->validate(trim($value)))) {
                    $error = true;
                }
            }
        }

        if ($error) {
            return [
                $this->message,
                []
            ];
        }

        return null;
    }

}