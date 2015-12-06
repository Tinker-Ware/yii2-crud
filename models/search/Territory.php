<?php

namespace app\models\search;

use netis\crud\db\ActiveSearchInterface;
use Yii;
use yii\base\Model;
use app\models\Territory as TerritoryModel;
use app\models\query\TerritoryQuery;

/**
 * Territory represents the model behind the search form about `\app\models\Territory`.
 */
class Territory extends TerritoryModel implements ActiveSearchInterface
{
    use \netis\crud\db\ActiveSearchTrait;

    /**
     * @inheritdoc
     */
    public function filteringRules()
    {
        return [
            [['TerritoryID', 'TerritoryDescription', 'RegionID'], 'trim'],
            [['TerritoryID', 'TerritoryDescription', 'RegionID'], 'default'],
            [['TerritoryID', 'RegionID'], 'filter', 'filter' => '\netis\crud\crud\Action::explodeKeys'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TerritoryID', 'TerritoryDescription'], 'safe'],
            [['RegionID'], 'each', 'rule' => ['integer', 'min' => -0x8000, 'max' => 0x7FFF]],
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
     * @return TerritoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TerritoryQuery('app\models\Territory');
    }
}
