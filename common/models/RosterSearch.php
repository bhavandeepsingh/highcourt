<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Roster;

/**
 * RosterSearch represents the model behind the search form about `common\models\Roster`.
 */
class RosterSearch extends Roster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'bench_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'description'], 'safe'],
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
    public function search($params = [], $login_id = 0, $as_array = false)
    {
        $query = Roster::find();

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
            'id' => $this->id,
            'bench_id' => $this->bench_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);
        
        if($as_array) $query->asArray(true);  
        
        $query->joinWith('judge');
        $query->joinWith(['bench'], true);

        return $dataProvider;
    }
    public static function getApiList($params = [], $login_id = 0, $as_array = false){
        $model = new RosterSearch();
        return $model->search($params, $login_id, $as_array);
    }
}
