<?php

namespace app\models\search;

use netis\crud\db\ActiveSearchInterface;
use Yii;
use yii\base\Model;
use app\models\Usstate as UsstateModel;
use app\models\query\UsstateQuery;

/**
 * Usstate represents the model behind the search form about `\app\models\Usstate`.
 */
class Usstate extends UsstateModel implements ActiveSearchInterface
{
    use \netis\crud\db\ActiveSearchTrait;

    /**
     * @inheritdoc
     */
    public function filteringRules()
    {
        return [
            [['StateID', 'StateName', 'StateAbbr', 'StateRegion'], 'trim'],
            [['StateID', 'StateName', 'StateAbbr', 'StateRegion'], 'default'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['StateID'], 'integer', 'min' => -0x8000, 'max' => 0x7FFF],
            [['StateName'], 'string', 'max' => 100],
            [['StateAbbr'], 'string', 'max' => 2],
            [['StateRegion'], 'string', 'max' => 50],
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
     * @return UsstateQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsstateQuery('app\models\Usstate');
    }
}
