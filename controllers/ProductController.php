<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use app\models\ContactForm;
use app\models\Product;
use yii\web\UploadedFile;
class ProductController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create',"edit","delete","index"],
                'rules' => [
                    [
                        'actions' => ['create',"edit","delete","index"],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            
        ];
    }

    public function actionCreate()
{
    $product = new Product();
 if (Yii::$app->request->isPost){
    if ($product->load(Yii::$app->request->post())) {
         $product->main_image = UploadedFile::getInstance($product, 'main_image');
          if ($product->main_image && $product->validate()) {                
                $product->main_image->saveAs('uploads/' . $product->main_image->baseName . '.' . $product->main_image->extension);
                //check for other images
                $product->other_images = UploadedFile::getInstances($product, 'other_images');
               $extraImages=[];
                if (!empty($product->other_images)) {
                    foreach ($product->other_images as $product_image) {
                        $product_image->saveAs('uploads/' . $product_image->baseName . '.' . $product_image->extension);
                        array_push($extraImages, $product_image->baseName . '.' . $product_image->extension);
                    }
                    $product->other_images=implode(",", $extraImages);
                }

                $product->save();
            yii::$app->getSession()->setFlash("success","Product created successfully");
            return $this->redirect("/product/");
            }
    }
    }

    return $this->render('create', [
        'product' => $product,
    ]);
}

    public function actionDelete($id)
    {
        $product=Product::findOne($id);
        $product->delete();

       yii::$app->getSession()->setFlash("success","Product deleted successfully");
            return $this->redirect("/product/");
    }

    public function actionEdit($id)
    {
          $product = Product::findOne($id);

    if ($product->load(Yii::$app->request->post())) {
        if ($product->validate()) {
             $main_image = UploadedFile::getInstance($product, 'main_image');
            $product->other_images="";
             if ($main_image) {
                $main_image->saveAs('uploads/' . $main_image->baseName . '.' . $main_image->extension);
                $product->main_image=$main_image;
             }

             // $other_images = UploadedFile::getInstances($product, 'other_images');
             //   $extraImages=[];
             //    if (!empty($other_images)) {
             //        foreach ($other_images as $product_image) {
             //            $product_image->saveAs('uploads/' . $product_image->baseName . '.' . $product_image->extension);
             //            array_push($extraImages, $product_image->baseName . '.' . $product_image->extension);
             //        }
             //        $product->other_images=implode(",", $extraImages);
             //    }
            $product->save();
            yii::$app->getSession()->setFlash("success","Product updated successfully");
            return $this->redirect("/product/");
        }
    }

    return $this->render('edit', [
        'product' => $product,
    ]);
    }

    public function actionIndex()
    {
        $query=Product::find();
        $pagination=new Pagination([
            "defaultPageSize"=>10,
            "totalCount"=>$query->count()
        ]);

        $products=$query->orderBy("created_at","desc")
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();
        return $this->render('index',["products"=>$products,"pagination"=>$pagination]);
    }

}
