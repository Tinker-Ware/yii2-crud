<?php

namespace app\models\search;

use netis\crud\db\ActiveSearchInterface;
use Yii;
use yii\base\Model;
use app\models\Employeeterritory as EmployeeterritoryModel;
use app\models\EmployeeterritoryQuery;

/**
 * Employeeterritory represents the model behind the search form about `\app\models\Employeeterritory`.
 */
class Employeeterritory extends EmployeeterritoryModel implements ActiveSearchInterface
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
     * @return EmployeeterritoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EmployeeterritoryQuery('app\models\Employeeterritory');
    }
}
