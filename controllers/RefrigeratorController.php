<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Refrigerator;
use yii\data\ActiveDataProvider;

class RefrigeratorController extends Controller
{
 
    public $layout = 'refrigeratorbase';

    public function actionIndex()
    {
    	$model = new Refrigerator();

        $provider_view = new ActiveDataProvider([
            'query' => $model->find()
            ->select(['timestampdiff(day, "'.date('Y-m-d').'", [[datelimit]]) as [[limitonnow]]', '[[id]]', '[[name]]', '[[datebuy]]', '[[datemake]]', '[[datelimit]]', 'timestampdiff(day, "'.date('Y-m-d').'", [[datelimit]]) as [[limitonnow_]]'])
            ->orderBy('[[limitonnow]]'),
            'pagination' => [
                'pageSize' => 5,
            ],
       ]);

       return $this->render('index', ['model' => $model, 'provider_view' => $provider_view]);
        
    }

    public function actionLeadDelete($name)
    {

       $model = new Refrigerator();

       $model->findOne($name)->delete();

       return $this->redirect('/refrigerator');

    }

    public function actionLeadEnter($id, $type_action, $name_title, $buy_date, $make_date, $limit_date)
    {

       $model = new Refrigerator();

       if($model->Ajaxspecialvalidation($name_title, $buy_date, $make_date, $limit_date)) {
	       if($type_action == 'update') 
	       {
		      $updating = $model->findOne($id);
		      $updating->name = $name_title;
		      $updating->datebuy = $buy_date;
		      $updating->datemake = $make_date;
		      $updating->datelimit = $limit_date;
		      $updating->update();
		   }
		   else if($type_action == 'add') 
		   {
		      $model->name = $name_title;
		      $model->datebuy = $buy_date;
		      $model->datemake = $make_date;
		      $model->datelimit = $limit_date;
		      $model->insert();
		   }
		   $dataReturn['result'] = 'success'; 
	   } 
	   else 
	   {
	   	  $dataReturn['result'] = 'error';
          $dataReturn['title'] = "Error of entering of data(field name must be <u>not empty</u>, fields date of... must be <u>yyyy-mm-dd</u>)";
	   }
       echo json_encode($dataReturn);

    }


}
