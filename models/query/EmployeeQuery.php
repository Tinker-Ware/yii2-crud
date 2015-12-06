<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Employee]].
 *
 * @see \app\models\Employee
 */
class EmployeeQuery extends \netis\crud\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\Employee[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Employee|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}