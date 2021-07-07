<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form ActiveForm */
$this->title = 'Edit Product';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="page-header">Edit Product <a onclick="return confirm('Are you sure to delete')" href="/product/delete?id=<?= $product->id ?>" class="btn btn-danger pull-right">Delete</a></h1>
<div class="product-edit">

    
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->field($product, 'name') ?>
        <?= $form->field($product, 'description')->textArea(["rows"=>"5"]) ?>
        <div class="main-image-preview">
            <img style="" src="<?= \Yii::$app->request->BaseUrl."/uploads/".$product->main_image ?>" class="img-responsive">
        </div>
        <?= $form->field($product, 'main_image')->fileInput() ?>
        
         <?= $form->field($product, 'other_images[]')->fileInput(["multiple"=>true]) ?>
        <?php 
            if (!empty($product->other_images)) {
                $other_images=explode(",", $product->other_images);
                foreach ($other_images as $key => $image) : ?>
<div class="other-image-preview">
            <img style="" src="<?= \Yii::$app->request->BaseUrl."/uploads/".$image ?>" class="img-responsive">
        </div>
                   
                
           <?php 

            endforeach;
                }
             ?>
        <div style="clear: both;" />
        <?= $form->field($product, 'quantity')->input('number', ['min' => 1, 'max' => 10000, 'step' => 1])  ?>
        <?= $form->field($product, 'price')->input('number', ['min' => 1, 'step' => 1])  ?>
      
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- product-edit -->
