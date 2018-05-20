<?php

namespace app\modules\webdriver\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Webstep;

/**
 * WebstepSearch represents the model behind the search form of `app\models\Webstep`.
 */
class WebstepSearch extends Webstep
{
    public $id_algorithm;
    public $id_source;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'step', 'id_source','id_algorithm'], 'integer'],
            [['text', 'selector'], 'safe'],
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
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Webstep::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
//        $query->andFilterWhere([
//            'id' => $this->id,
//            'step' => $this->step,
//        ]);
      //  if ($this->id_source) $query->andWhere(['id_source' => $this->id_source]);
        if ($this->id_algorithm) $query->andWhere(['id_algorithm' => $this->id_algorithm]);
//
//        $query->andFilterWhere(['like', 'text', $this->text])
//            ->andFilterWhere(['like', 'selector', $this->selector]);

        return $dataProvider;
    }
}
