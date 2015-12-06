<?php

namespace app\models\search;

use netis\crud\db\ActiveSearchInterface;
use Yii;
use yii\base\Model;
use app\models\CustomerCustomerDemo as CustomerCustomerDemoModel;
use app\models\query\CustomerCustomerDemoQuery;

/**
 * CustomerCustomerDemo represents the model behind the search form about `\app\models\CustomerCustomerDemo`.
 */
class CustomerCustomerDemo extends CustomerCustomerDemoModel implements ActiveSearchInterface
{
    use \netis\crud\db\ActiveSearchTrait;

    /**
     * @inheritdoc
     */
    public function filteringRules()
    {
        return [
            [['CustomerID', 'CustomerTypeID'], 'trim'],
            [['CustomerID', 'CustomerTypeID'], 'default'],
            [['CustomerID', 'CustomerTypeID'], 'filter', 'filter' => '\netis\crud\crud\Action::explodeKeys'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CustomerID', 'CustomerTypeID'], 'safe'],
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
     * @return CustomerCustomerDemoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustomerCustomerDemoQuery('app\models\CustomerCustomerDemo');
    }
}
