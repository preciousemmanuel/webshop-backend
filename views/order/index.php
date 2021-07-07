<?php
/* @var $this yii\web\View */
use yii\widgets\LinkPager;
$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="page-header">Orders</h1>

<div class="row">
	<?php if($orders): ?>
	<table class="table">
		<thead>
			<th>S/N</th>
			<th>Customer Name</th>
			<th>Phone</th>
			<th>Email</th>
			<th>Date</th>
			<th>Status</th>
			<th></th>
		</thead>
		<tbody>
			<?php foreach ($orders as $key => $order) : ?>
				<tr>
					<td><?= $key+1 ?></td>
					<td><?= $order->first_name ." ".$order->last_name?></td>
					<td><?= $order->phone ?></td>
					<td><?= $order->email ?></td>
					<td><?= $order->created_at ?></td>
					
					<td>

						<?= $order->status=="pending" ||$order->status=="Canceled"?"<span class='text text-danger'>".$order->status."</span>":"<span class='text text-success'>Delivered</span>" ?></td>
					<td>
						
					</td>
					<td><button data-toggle="modal" data-target="#openModal<?= $order->id ?>" class="btn btn-primary">More</button>

						   <div style="background-color: rgba(0, 0, 0, 0.5);z-index: 1" class="modal fade" id="openModal<?= $order->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Products</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
						 <div class="modal-body" style="color: #333 !important">
                
                 
              <div class="table">
                <table class="table">
                  <thead>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($order->orderHistory as $key => $orderhistory): ?>
                     <tr>
                             <td><?= $orderhistory->product->name ?></td> 
                             <td><?= $orderhistory->quantity ?></td> 
                             <td>
                             <?= $orderhistory->amount ?>
                            </td> 
                            </tr>
                          <?php
                      endforeach;
                            ?>
                  </tbody>
                </table>
              </div>  
              
              <div class="modal-footer bg-whitesmoke br">
                
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
    </div>
             

					</td>

					<td>
						<select  class="updateStatus" id="<?= $order->id?>">
							<option>Pending</option>
							<option>Canceled</option>
							<option>Delivered</option>
						</select>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>



<?= LinkPager::widget(["pagination"=>$pagination]) ?>
	<?php else: ?>
		<div class="alert alert-danger">No orders for now</div>
	<?php endif; ?>
</div>


