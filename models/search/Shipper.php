<?php

namespace app\models\search;

use netis\crud\db\ActiveSearchInterface;
use Yii;
use yii\base\Model;
use app\models\Shipper as ShipperModel;
use app\models\ShipperQuery;

/**
 * Shipper represents the model behind the search form about `\app\models\Shipper`.
 */
class Shipper extends ShipperModel implements ActiveSearchInterface
{
    use \netis\crud\db\ActiveSearchTrait;

    /**
     * @inheritdoc
     */
    public function filteringRules()
    {
        return [
            [['ShipperID', 'CompanyName', 'Phone'], 'trim'],
            [['ShipperID', 'CompanyName', 'Phone'], 'default'],
            [['ShipperID'], 'filter', 'filter' => '\netis\crud\crud\Action::explodeKeys'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ShipperID'], 'each', 'rule' => ['integer', 'min' => -0x8000, 'max' => 0x7FFF]],
            [['CompanyName'], 'string', 'max' => 40],
            [['Phone'], 'string', 'max' => 24],
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
     * @return ShipperQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ShipperQuery('app\models\Shipper');
    }
}
