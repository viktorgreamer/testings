<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "algorithm".
 *
 * @property int $id
 * @property int $id_source
 * @property string $name
 * @property int $id_account
 */
class Algorithm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'algorithm';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_source', 'id_account'], 'integer'],
            [['name'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_source' => 'Id Source',
            'name' => 'Name',
            'id_account' => 'Id Account',
        ];
    }

    /**
     * @inheritdoc
     * @return AlgorithmQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AlgorithmQuery(get_called_class());
    }

    public static function getAlgorithm($id_source = null)
    {
        return ArrayHelper::map(self::find()->filterwhere(['id_source' => $id_source])->all(), 'id', 'name');
    }

    public function getSteps()
    {
        return $this->hasMany(Webstep::className(), ['id_algorithm' => 'id']);
    }

    public function getQuerySteps() {
        return Webstep::find()->where(['id_algorithm' => $this->id])->andWhere(['<>','type', Webstep::EXCEPTION_TYPE]);
    }

    public function getQueryStepsExceptions() {
        return Webstep::find()->where(['id_algorithm' => $this->id])->andWhere(['type' => Webstep::EXCEPTION_TYPE]);
    }

    public function getSource() {
        return $this->hasOne(Sources::className(), ['id' => 'id_source']);
    }
}
