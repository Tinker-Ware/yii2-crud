<?php

namespace app\models\search;

use netis\crud\db\ActiveSearchInterface;
use Yii;
use yii\base\Model;
use app\models\CustomerDemographic as CustomerDemographicModel;
use app\models\query\CustomerDemographicQuery;

/**
 * CustomerDemographic represents the model behind the search form about `\app\models\CustomerDemographic`.
 */
class CustomerDemographic extends CustomerDemographicModel implements ActiveSearchInterface
{
    use \netis\crud\db\ActiveSearchTrait;

    /**
     * @inheritdoc
     */
    public function filteringRules()
    {
        return [
            [['CustomerTypeID', 'CustomerDesc'], 'trim'],
            [['CustomerTypeID', 'CustomerDesc'], 'default'],
            [['CustomerTypeID'], 'filter', 'filter' => '\netis\crud\crud\Action::explodeKeys'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CustomerTypeID', 'CustomerDesc'], 'safe'],
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
     * @return CustomerDemographicQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustomerDemographicQuery('app\models\CustomerDemographic');
    }
}
