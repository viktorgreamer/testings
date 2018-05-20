<?php

namespace app\modules\webdriver\models;

/**
 * This is the ActiveQuery class for [[Algorithm]].
 *
 * @see Algorithm
 */
class AlgorithmQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Algorithm[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Algorithm|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
