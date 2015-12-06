<?php

namespace app\models\search;

use netis\crud\db\ActiveSearchInterface;
use Yii;
use yii\base\Model;
use app\models\Supplier as SupplierModel;
use app\models\SupplierQuery;

/**
 * Supplier represents the model behind the search form about `\app\models\Supplier`.
 */
class Supplier extends SupplierModel implements ActiveSearchInterface
{
    use \netis\crud\db\ActiveSearchTrait;

    /**
     * @inheritdoc
     */
    public function filteringRules()
    {
        return [
            [['SupplierID', 'CompanyName', 'ContactName', 'ContactTitle', 'Address', 'City', 'Region', 'PostalCode', 'Country', 'Phone', 'Fax', 'HomePage'], 'trim'],
            [['SupplierID', 'CompanyName', 'ContactName', 'ContactTitle', 'Address', 'City', 'Region', 'PostalCode', 'Country', 'Phone', 'Fax', 'HomePage'], 'default'],
            [['SupplierID'], 'filter', 'filter' => '\netis\crud\crud\Action::explodeKeys'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['HomePage'], 'safe'],
            [['SupplierID'], 'each', 'rule' => ['integer', 'min' => -0x8000, 'max' => 0x7FFF]],
            [['CompanyName'], 'string', 'max' => 40],
            [['ContactName', 'ContactTitle'], 'string', 'max' => 30],
            [['Address'], 'string', 'max' => 60],
            [['City', 'Region', 'Country'], 'string', 'max' => 15],
            [['PostalCode'], 'string', 'max' => 10],
            [['Phone', 'Fax'], 'string', 'max' => 24],
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
     * @return SupplierQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SupplierQuery('app\models\Supplier');
    }
}
