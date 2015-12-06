<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\CustomerDemographic]].
 *
 * @see \app\models\CustomerDemographic
 */
class CustomerDemographicQuery extends \netis\crud\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\CustomerDemographic[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\CustomerDemographic|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}