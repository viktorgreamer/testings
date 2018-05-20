<?php

namespace app\modules\webdriver\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "webstep".
 *
 * @property int $id
 * @property int $step
 * @property int $id_algorithm
 * @property string $text
 * @property string $selector
 * @property string $preg_match
 * @property string $if_true
 * @property string $if_false
 */
class Webstep extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'webstep';
    }

    const EXCEPTION_TYPE = 3;
    const STEP_TYPE = 1;

    public function TYPES()
    {
        return [
            Webstep::STEP_TYPE => "STEP",
            Webstep::EXCEPTION_TYPE => "EXCEPTION",
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['step', 'id_algorithm'], 'required'],
            [['step', 'id_algorithm', 'type'], 'integer'],
            [['text', 'selector', 'preg_match', 'name', 'if_true', 'if_false'], 'string', 'max' => 256],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'step' => 'Step',
            'text' => 'Text/url/duration',
            'selector' => 'Selector',
            'id_algorithm' => 'Algorithm',
            'preg_match' => 'preg_match',
            'name' => 'name',
            'type' => 'type',
        ];
    }

    /**
     * @inheritdoc
     * @return WebstepQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WebstepQuery(get_called_class());
    }

    public static function getExceptons($id_algorithm = 0)
    {
        return ArrayHelper::map(Webstep::find()
            ->where(['type' => Webstep::EXCEPTION_TYPE])
            ->andFilterWhere(['id_algorithm' => $id_algorithm])
            ->all(), 'id', 'name');
    }
    public static function getNamedExceptons($id_algorithm = 0)
    {
        $names = Webstep::find()
            ->select('name')
            ->distinct()
            ->where(['type' => Webstep::EXCEPTION_TYPE])
            ->andFilterWhere(['id_algorithm' => $id_algorithm])
            ->column();
        return array_combine($names, $names);
    }

    public function getAlgorithm()
    {
        return $this->hasOne(Algorithm::className(), ['id' => 'id_algorithm']);
    }

    public static function getExceptions($id_algorithm = 0, $name = '')
    {
        // get exceptions for unique $id_algorithm and $name
        if (($id_algorithm) && ($name)) {
            return Webstep::find()
                ->where(['type' => self::EXCEPTION_TYPE])
                ->andWhere(['id_algorithm' => $id_algorithm])
                ->andWhere(['name' => $name])
                ->all();
        } else return false;

    }


}
