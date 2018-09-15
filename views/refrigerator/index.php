<?php
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
?>

<div class="form">
<h4>Add new record (or Update <b><u>selected from list</u></b> record)</h4>

<div class="table">

<div class="table_row">
<?php
    $form = ActiveForm::begin([
       'options' => ['class' => 'form_refrigerator', 'name' => 'form_refrigerator'],]);
    ?>

<div class="table_cell">
 <?= $form->field($model, 'name')->textInput(array('placeholder'=>'not empty', 'class'=>'name_title', 'value'=>''))->label('name'); ?>
 </div>
 <div class="table_cell">
 <?= $form->field($model, 'datebuy')->textInput(array('placeholder'=>'yyyy-mm-dd', 'class'=>'buy_date', 'value'=>''))->label('date of buy'); ?>
 </div>
 <div class="table_cell">
 <?= $form->field($model, 'datemake')->textInput(array('placeholder'=>'yyyy-mm-dd', 'class'=>'make_date', 'value'=>''))->label('date of make'); ?>
 </div>
 <div class="table_cell">
 <?= $form->field($model, 'datelimit')->textInput(array('placeholder'=>'yyyy-mm-dd', 'class'=>'limit_date', 'value'=>''))->label('date of limit'); ?>
 </div>
 <div class="table_cell">
 <?= Html::button('Enter', ['class' => 'button_add', 'name' => 'add']) ?>
 </div>
<?php ActiveForm::end() ?>
</div>

<div class="table_row">
<div class="table_cell">
<span class="title_error">&nbsp;</span> 
</div>
</div>

</div>

</div>

<hr>

<div class="content">
<h4>List records (with function <b>updating</b> and <b>removing</b>)</h4>

<?php
echo GridView::widget([
    'dataProvider' => $provider_view,
      'filterModel' => \yii\jui\DatePicker::widget([
        'model'=>$provider_view,
        'attribute'=>'updated_at',
        'language' => 'en',
        'dateFormat' => 'yyyy-mm-dd',
      ]),
        'rowOptions' => function ($provider_view, $key, $index, $grid) {
            if($provider_view->datelimit < date('Y-m-d')) {return ['style' => 'color:red;'];}
            if($provider_view->datelimit == date('Y-m-d')) {return ['style' => 'color:orange;'];}
         },
        'columns' => [
           ['class' => 'yii\grid\SerialColumn'],
           ['label' => 'name', 'attribute' => 'name'],
           ['label' => 'date of buy', 'attribute' => 'datebuy'],
           ['label' => 'date of make', 'attribute' => 'datemake'],
           ['label' => 'date of limit', 'attribute' => 'datelimit'],
           ['class' => 'yii\grid\ActionColumn',
            'template' => '{leadUpdate}{leadDelete}',

            'buttons'  => [
                'leadUpdate' => function ($url, $provider_view) {
                     return Html::a('<div class="fa fa-update" name="'.$provider_view->id.'">update</div>', 'javascript:void(0);', []);
                },
                'leadDelete' => function ($url, $provider_view) {
                    $url = Url::to([mb_strtolower($provider_view->formName()).'/lead-delete', 'name' => $provider_view->id]);
                    return Html::a('<div class="fa fa-delete">delete</div>', $url, [
                        'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    ]);
                },


              ],

           ],

        ],

]);
?>

</div>
