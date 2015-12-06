<?php

namespace app\models\search;

use netis\crud\db\ActiveSearchInterface;
use Yii;
use yii\base\Model;
use app\models\OrderDetail as OrderDetailModel;
use app\models\OrderDetailQuery;

/**
 * OrderDetail represents the model behind the search form about `\app\models\OrderDetail`.
 */
class OrderDetail extends OrderDetailModel implements ActiveSearchInterface
{
    use \netis\crud\db\ActiveSearchTrait;

    /**
     * @inheritdoc
     */
    public function filteringRules()
    {
        return [
            [['OrderID', 'ProductID', 'UnitPrice', 'Quantity', 'Discount'], 'trim'],
            [['OrderID', 'ProductID', 'UnitPrice', 'Quantity', 'Discount'], 'default'],
            [['OrderID', 'ProductID'], 'filter', 'filter' => '\netis\crud\crud\Action::explodeKeys'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Quantity'], 'integer', 'min' => -0x8000, 'max' => 0x7FFF],
            [['OrderID', 'ProductID'], 'each', 'rule' => ['integer', 'min' => -0x8000, 'max' => 0x7FFF]],
            [['UnitPrice', 'Discount'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * @inheritdoc
     * @return OrderDetailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderDetailQuery('app\models\OrderDetail');
    }
}
