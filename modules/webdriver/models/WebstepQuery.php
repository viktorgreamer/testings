<?php

namespace app\modules\webdriver\models;

/**
 * This is the ActiveQuery class for [[Webstep]].
 *
 * @see Webstep
 */
class WebstepQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Webstep[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Webstep|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
