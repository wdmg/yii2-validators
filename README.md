[![Yii2](https://img.shields.io/badge/required-Yii2_v2.0.40-blue.svg)](https://packagist.org/packages/yiisoft/yii2)
[![Downloads](https://img.shields.io/packagist/dt/wdmg/yii2-validators.svg)](https://packagist.org/packages/wdmg/yii2-validators)
[![Packagist Version](https://img.shields.io/packagist/v/wdmg/yii2-validators.svg)](https://packagist.org/packages/wdmg/yii2-validators)
![Progress](https://img.shields.io/badge/progress-in_development-red.svg)
[![GitHub license](https://img.shields.io/github/license/wdmg/yii2-validators.svg)](https://github.com/wdmg/yii2-validators/blob/master/LICENSE)

# Yii2 Validators
Custom validators for Yii2

# Requirements 
* PHP 5.6 or higher
* Yii2 v.2.0.40 and newest

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
            [['attribute'], StopListValidator::class, 'stoplist' => ['admin', 'root', 'superuser', ...], 'message' => 'You can not use this value `{value}` for field `{attribute}`'],
            ...
        ];
    }
    
    ?>

# Status and version [in progress development]
* v.1.1.0 - Update copyrights
* v.1.0.7 - StopListValidator renamed to ReservedValidator
* v.1.0.6 - Update README.md and dependencies