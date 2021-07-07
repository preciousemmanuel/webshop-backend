<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_orders}}".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property string $email
 * @property string $phone
 * @property string|null $note
 * @property float $delivery_fee
 * @property string $city
 * @property string $created_at
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_orders}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'address',  'phone'], 'required'],
            [['address', 'note','status'], 'string'],
            
            [['created_at'], 'safe'],
            [['first_name', 'last_name', 'email', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'address' => 'Address',
            'email' => 'Email',
            'phone' => 'Phone',
            'note' => 'Note',
            'delivery_fee' => 'Delivery Fee',
            'city' => 'City',
            'created_at' => 'Created At',
        ];
    }
    public function getOrderHistory(){
        return $this->hasMany(OrderHistory::class,["order_id"=>"id"]);
    }

    /**
     * {@inheritdoc}
     * @return OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderQuery(get_called_class());
    }

}
