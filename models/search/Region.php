<?php

namespace app\models\search;

use netis\crud\db\ActiveSearchInterface;
use Yii;
use yii\base\Model;
use app\models\Region as RegionModel;
use app\models\query\RegionQuery;

/**
 * Region represents the model behind the search form about `\app\models\Region`.
 */
class Region extends RegionModel implements ActiveSearchInterface
{
    use \netis\crud\db\ActiveSearchTrait;

    /**
     * @inheritdoc
     */
    public function filteringRules()
    {
        return [
            [['RegionID', 'RegionDescription'], 'trim'],
            [['RegionID', 'RegionDescription'], 'default'],
            [['RegionID'], 'filter', 'filter' => '\netis\crud\crud\Action::explodeKeys'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['RegionDescription'], 'safe'],
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
     * @return RegionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RegionQuery('app\models\Region');
    }
}
