<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Holidays;

/**
 * JudgesSearch represents the model behind the search form about `common\models\Judges`.
 */
class HolidaysSearch extends Holidays
{
    public function search($params, $login_id = 0, $as_array = false)
    {
        $query = Holidays::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $this->load($params);
//        if (!$this->validate()) {
//            
//            // uncomment the following line if you do not want to return any records when validation fails
//            // $query->where('0=1');
//            return $dataProvider;
//        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'date' => $this->date,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'date', $this->date])
                ->andFilterWhere(['like', 'date', date("Y")]);
        
        $query->with('highcourts') ;
        $query->orderBy('date ASC');
        if($as_array) $query->asArray(true);
                      
        
        return $dataProvider;
    }
    
    public static function getApiList($params = [], $login_id = 0, $as_array = false){
        $model = new HolidaysSearch();
        return $model->search($params, $login_id, $as_array);
    }
   
}
