<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_product}}".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $main_image
 * @property int $user_id
 * @property string $created_at
 * @property int $quantity
 * @property float $price
 * @property string $updated_at
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_product}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description',   'quantity', 'price'], 'required'],
            [['description'], 'string'],
            [['quantity'], 'integer'],
            [['main_image'], 'file'],
            [['other_images'], 'file','maxFiles' => 10],
            [['created_at', 'updated_at'], 'safe'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 255],
        ];
    }

     public function beforeSave($insert){
        $this->user_id=yii::$app->user->identity->id;
        return parent::beforeSave($insert);
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Product Name',
            'description' => 'Description',
            'main_image' => 'Main Image',
            'other_images' => 'Product Images(You can upload multiple images)',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'quantity' => 'Quantity',
            'price' => 'Price(N)',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }
}
