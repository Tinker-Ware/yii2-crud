<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_details".
 *
 * @property integer $OrderID
 * @property integer $ProductID
 * @property double $UnitPrice
 * @property integer $Quantity
 * @property double $Discount
 */
class OrderDetail extends \netis\crud\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_details';
    }

    /**
     * @inheritdoc
     */
    public function filteringRules()
    {
        return [
            [['OrderID', 'ProductID', 'UnitPrice', 'Quantity', 'Discount'], 'trim'],
            [['OrderID', 'ProductID', 'UnitPrice', 'Quantity', 'Discount'], 'default'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OrderID', 'ProductID', 'UnitPrice', 'Quantity', 'Discount'], 'required'],
            [['OrderID', 'ProductID', 'Quantity'], 'integer', 'min' => -0x8000, 'max' => 0x7FFF],
            [['UnitPrice', 'Discount'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'OrderID' => Yii::t('app', 'Order ID'),
            'ProductID' => Yii::t('app', 'Product ID'),
            'UnitPrice' => Yii::t('app', 'Unit Price'),
            'Quantity' => Yii::t('app', 'Quantity'),
            'Discount' => Yii::t('app', 'Discount'),
        ];
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'labels' => [
                'class' => 'netis\crud\db\LabelsBehavior',
                'attributes' => ['OrderID'],
                'crudLabels' => [
                    'default'  => Yii::t('app', 'Order Detail'),
                    'relation' => Yii::t('app', 'Order Details'),
                    'index'    => Yii::t('app', 'Browse Order Details'),
                    'create'   => Yii::t('app', 'Create Order Detail'),
                    'read'     => Yii::t('app', 'View Order Detail'),
                    'update'   => Yii::t('app', 'Update Order Detail'),
                    'delete'   => Yii::t('app', 'Delete Order Detail'),
                ],
            ],
        ]);
    }

    /**
     * @inheritdoc
     */
    public static function relations()
    {
        return [
        ];
    }

    /**
     * @inheritdoc
     * @return OrderDetailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderDetailQuery(get_called_class());
    }
}
