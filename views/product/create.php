<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form ActiveForm */
$this->title = 'Create Product';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="page-header">Create Product</h1>

<div class="product-create">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->field($product, 'name') ?>
        <?= $form->field($product, 'description')->textArea(["rows"=>"5"]) ?>
        <?= $form->field($product, 'main_image')->fileInput() ?>
         <?= $form->field($product, 'other_images[]')->fileInput(["multiple"=>true]) ?>
        
        <?= $form->field($product, 'quantity')->input('number', ['min' => 1, 'max' => 10000, 'step' => 1])  ?>
        <?= $form->field($product, 'price')->input('number', ['min' => 1, 'step' => 1])  ?>
      
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- product-create -->
