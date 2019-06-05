[![Progress](https://img.shields.io/badge/required-Yii2_v2.0.13-blue.svg)](https://packagist.org/packages/yiisoft/yii2) [![Github all releases](https://img.shields.io/github/downloads/wdmg/yii2-validators/total.svg)](https://GitHub.com/wdmg/yii2-validators/releases/) [![GitHub version](https://badge.fury.io/gh/wdmg%2Fyii2-validators.svg)](https://github.com/wdmg/yii2-validators) ![Progress](https://img.shields.io/badge/progress-in_development-red.svg) [![GitHub license](https://img.shields.io/github/license/wdmg/yii2-validators.svg)](https://github.com/wdmg/yii2-validators/blob/master/LICENSE)

# Yii2 Validators
Custom validators for Yii2

# Requirements 
* PHP 5.6 or higher
* Yii2 v.2.0.20 and newest

# Installation
To install the validators, run the following command in the console:

`$ composer require "wdmg/yii2-validators"`

# Usage
Example of usecase StopListValidator to model rules:

    <?php
    
    use wdmg\validators\StopListValidator;
    ...
    
    public function rules() {
        return [
            [['attribute'], StopListValidator::className(), 'stoplist' => ['admin', 'root', 'superuser', ...], 'message' => 'You can not use this value `{value}` for field `{attribute}`'],
            ...
        ];
    }
    
    ?>

# Status and version [in progress development]
* v.1.0.3 - Update Yii2 version