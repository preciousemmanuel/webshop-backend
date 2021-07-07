<?php

namespace app\controllers;
use app\models\Product;
use Yii;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;

class StockController extends ActiveController
{
 public $modelClass=Product::class;


public function behaviors(){
    $behaviors=parent::behaviors();
    $behaviors["authenticator"]["only"]=[
        "create","update","delete"
    ];
    $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::class,
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
            ],
        ];

    $behaviors["authenticator"]['authMethods']=[
        HttpBearerAuth::class
    ];
    return $behaviors;
}

 public function actions()
{
    $actions = parent::actions();

    // disable the "delete" and "create" actions
    unset($actions['delete'], $actions['create'],$actions['update']);

    // customize the data provider preparation with the "prepareDataProvider()" method
    // $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

    return $actions;
}
}
