<?php

namespace app\models\search;

use netis\crud\db\ActiveSearchInterface;
use Yii;
use yii\base\Model;
use app\models\Category as CategoryModel;
use app\models\CategoryQuery;

/**
 * Category represents the model behind the search form about `\app\models\Category`.
 */
class Category extends CategoryModel implements ActiveSearchInterface
{
    use \netis\crud\db\ActiveSearchTrait;

    /**
     * @inheritdoc
     */
    public function filteringRules()
    {
        return [
            [['CategoryID', 'CategoryName', 'Description', 'Picture'], 'trim'],
            [['CategoryID', 'CategoryName', 'Description', 'Picture'], 'default'],
            [['CategoryID'], 'filter', 'filter' => '\netis\crud\crud\Action::explodeKeys'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Description', 'Picture'], 'safe'],
            [['CategoryID'], 'each', 'rule' => ['integer', 'min' => -0x8000, 'max' => 0x7FFF]],
            [['CategoryName'], 'string', 'max' => 15],
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
     * @return CategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategoryQuery('app\models\Category');
    }
}
