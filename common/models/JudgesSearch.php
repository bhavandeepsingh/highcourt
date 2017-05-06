<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Judges;

/**
 * JudgesSearch represents the model behind the search form about `common\models\Judges`.
 */
class JudgesSearch extends Judges
{
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'address', 'dob', 'date_of_appointment', 'date_of_retirement', 'bio_graphy', 'landine'], 'safe'],
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
        $query = Judges::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

//        if (!$this->validate()) {
//            // uncomment the following line if you do not want to return any records when validation fails
//            // $query->where('0=1');
//            return $dataProvider;
//        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'dob' => $this->dob,
            'date_of_appointment' => $this->date_of_appointment,
            'date_of_retirement' => $this->date_of_retirement,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        if(is_numeric($this->name)){
            $query->andWhere([ 'court_room'=> $this->name]);
        }
        else{
            $query->andFilterWhere(['like', 'name', $this->name]);
        }
        
        $query->addSelect(['*', 'getImageSrc("'.$this->getImageTypePathApi().'", id) as image_src']);
        $query->limit(100);
        if($as_array) $query->asArray(true);
                      
        
        return $dataProvider;
    }
    
    public static function getApiList($params = [], $login_id = 0, $as_array = false){
        $model = new JudgesSearch();
        return $model->search($params, $login_id, $as_array);
    }
    
}
