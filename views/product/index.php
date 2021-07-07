<?php
/* @var $this yii\web\View */
use yii\widgets\LinkPager;
$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="page-header">Products <a href="/product/create" class="btn btn-primary pull-right">Create</a></h1>

<div class="row">
	<?php foreach ($products as $key => $product) : ?>
		<div class="col-md-4 col-sm-3 panel">
			<div class="panel-header">
				<center>
					<h4> <?= $product->name ?></h4>
				</center>
			</div>
			<div class="panel-body">

				<img class="img-responsive" src='<?= \Yii::$app->request->BaseUrl."/uploads/".$product->main_image ?>'>
			</div>
			<div class="panel-footer">
				<span class="pull-lefts">
					<ul class="list-group">
						<li class="list-group-item">
							<strong>Quantity:</strong>
					<?= $product->quantity ?>
						</li>
						<li class="list-group-item">
							<strong>Price:</strong>N
					<?= number_format($product->price) ?>
						</li>
					</ul>
					
				</span>
				<a href="/product/edit?id=<?= $product->id ?>" style="margin-top: -7px" class="my-2 btn btn-primary pull-righst">Edit</a>
			</div>
		</div>

	<?php endforeach ; ?>
</div>


<?= LinkPager::widget(["pagination"=>$pagination]) ?>

