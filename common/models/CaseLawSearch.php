<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CaseLaw;

/**
 * CaseLawSearch represents the model behind the search form about `common\models\CaseLaw`.
 */
class CaseLawSearch extends CaseLaw
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['discription', 'title'], 'safe'],
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
    public function search($params, $login_id = 0, $as_array = false)
    {
        $this->login_id = $login_id;
        
        $query = CaseLaw::find()->alias('c');

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
        $query->andFilterWhere([
            'c.id' => $this->id,
            'c.created_at' => $this->created_at,
            'c.updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'c.discription', $this->discription])
            ->andFilterWhere(['like', 'c.title', $this->title]);
        
        $query->joinWith(['caseStatus' => function($q){
            $q->onCondition(['user_id' => $this->login_id]);
            $q->alias('cS');
        }], false, 'LEFT JOIN');
        
        $query->addSelect(['c.*', 'cS.id as is_read']);
        
        $query->asArray($as_array);
        
        return $dataProvider;
    }
    public static function getApiList($params = [], $login_id = 0, $as_array = false){
        $model = new CaseLawSearch();
        return $model->search($params, $login_id, $as_array);
    }
}
