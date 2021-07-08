<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use app\models\Order;
use app\models\OrderHistory;
use app\models\Product;
use yii\filters\auth\HttpBearerAuth;

class OrderController  extends \yii\web\Controller
{
	public $enableCsrfValidation = false;

public function behaviors()
    {
        return [

        	'corsFilter'=> [
            'class' => \yii\filters\Cors::class,
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
            ],
        ],
        // 'access' => [
        //         'class' => AccessControl::className(),
        //         'only' => ['create',"edit","delete","index"],
        //         'rules' => [
        //             [
        //                 'actions' => ['create',"edit","delete","index"],
        //                 'allow' => true,
        //                 'roles' => ['@'],
        //             ],
        //         ],
        //     ],
    ];

    }



    public function actionIndex()
    {
    	 $query=Order::find();
        $pagination=new Pagination([
            "defaultPageSize"=>10,
            "totalCount"=>$query->count()
        ]);

        $orders=$query->orderBy("created_at","desc")
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();
        return $this->render('index',["orders"=>$orders,"pagination"=>$pagination]);
        
    }
    public function actionUpdate(){
    	$request = Yii::$app->request;

    	$orderId=$request->post("orderId");
    	$status=$request->post("status");
    	$quantity=$request->post("quantity");
    	//var_dump($orderId);
    	$order=Order::findOne($orderId);
    	//var_dump(expression)

    	$order->status=$status;
    	
    	$order->save();
    	
    	return $this->asJson(
            ["status"=>true]
        );
    }

    public function actionCreate()
    {
        $request = Yii::$app->request;
        $connection = \Yii::$app->db;
        $order_request=$request->post("cart");
        $first_name=$request->post("first_name");
        $last_name=$request->post("last_name");
        $email=$request->post("email");
        $address=$request->post("address");
        $note=$request->post("note");
        $phone=$request->post("phone");
        $transaction = $connection->beginTransaction();
        try {
        $order=new Order();
        $order->attributes=[
        	"first_name"=>$first_name,
        	"last_name"=>$last_name,
        	"email"=>$email,
        	"address"=>$address,
        	"note"=>$note,
        	"phone"=>$phone
        ];

        if (!$order->validate()) {
        	return $this->errorResponse($order->errors);
        }


        $order->save();

//var_dump($order);
        //save order history
        foreach ($order_request as $key => $value) {
        	$orderRq=(object)$value;
        	//var_dump($orderRq->price);
        	$OrderHistory=new OrderHistory();
        	$OrderHistory->attributes=[
        		"order_id"=>$order->id,
        		"product_id"=>$orderRq->id,
        		"quantity"=>$orderRq->quantity,
        		"amount"=>$orderRq->price,
        		"total_amount"=>$orderRq->quantity*$orderRq->price,
        	];
        	if (!$OrderHistory->validate()) {
        	return $this->errorResponse($OrderHistory->errors);
        }
        	$OrderHistory->save();
        }
         $transaction->commit();
        return $this->asJson(
            ["status"=>true]
        );
       
       // return $this->asJson([$order]); 
    }catch(\Exception $e){
    	//$transaction->rollBack();

		//throw $e;
    	return $this->errorResponse($e);
        
    }
}

    private function errorResponse($message) {
                                
    // set response code to 400
    Yii::$app->response->statusCode = 400;

    return $this->asJson(['error' => $message]);
    }
}


