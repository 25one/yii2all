<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\base\DynamicModel;

class Refrigerator extends ActiveRecord
{

    public function rules()
    {
        return [

           //...

        ];
    }

    public function Ajaxspecialvalidation($name, $datebuy, $datemake, $datelimit)
    {
       $model = new DynamicModel(compact('name', 'datebuy', 'datemake', 'datelimit'));
       $model->addRule(['name', 'datebuy', 'datemake', 'datelimit'], 'required')
           ->addRule('datebuy', 'date', ['format' => 'php:Y-m-d'])
           ->addRule('datemake', 'date', ['format' => 'php:Y-m-d'])
           ->addRule('datelimit', 'date', ['format' => 'php:Y-m-d'])  
           ->validate();

       if (!$model->validate()) {
           return false;
       }
       else {
           return true; 
       }

    }

}
