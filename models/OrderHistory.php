<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_order_history}}".
 *
 * @property int $id
 * @property int $product_id
 * @property int $quantity
 * @property int $order_id
 * @property float $amount
 * @property string $created_at
 */
class OrderHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_order_history}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'quantity', 'amount'], 'required'],
            [['product_id', 'quantity'], 'integer'],
            [['amount','total_amount'], 'number'],
            [['order_id'], 'number'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'quantity' => 'Quantity',
            'amount' => 'Amount',
            'created_at' => 'Created At',
        ];
    }

    public function getProduct(){
        return $this->hasOne(Product::class,["id"=>"product_id"]);
    }
    /**
     * {@inheritdoc}
     * @return OrderHistoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderHistoryQuery(get_called_class());
    }
}
