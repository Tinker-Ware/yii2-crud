<?php

namespace app\models\search;

use netis\crud\db\ActiveSearchInterface;
use Yii;
use yii\base\Model;
use app\models\EmployeeTerritory as EmployeeTerritoryModel;
use app\models\query\EmployeeTerritoryQuery;

/**
 * EmployeeTerritory represents the model behind the search form about `\app\models\EmployeeTerritory`.
 */
class EmployeeTerritory extends EmployeeTerritoryModel implements ActiveSearchInterface
{
    use \netis\crud\db\ActiveSearchTrait;

    /**
     * @inheritdoc
     */
    public function filteringRules()
    {
        return [
            [['EmployeeID', 'TerritoryID'], 'trim'],
            [['EmployeeID', 'TerritoryID'], 'default'],
            [['EmployeeID', 'TerritoryID'], 'filter', 'filter' => '\netis\crud\crud\Action::explodeKeys'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TerritoryID'], 'safe'],
            [['EmployeeID'], 'each', 'rule' => ['integer', 'min' => -0x8000, 'max' => 0x7FFF]],
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
     * @return EmployeeTerritoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EmployeeTerritoryQuery('app\models\EmployeeTerritory');
    }
}
