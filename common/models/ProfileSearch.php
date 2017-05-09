<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Profile;

/**
 * MembersSearch represents the model behind the search form about `common\models\Members`.
 */
class ProfileSearch extends Profile
{

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
    public function search($params = [], $login_id = 0, $as_array = false, $is_executive = false)
    {
        
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getQueryDataProvider($params, $login_id, $as_array),
        ]);

        

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
      
        return $dataProvider;
    }
    
    public function getQueryDataProvider($params = [], $login_id = 0, $as_array = false){
        
        $query = Profile::find();
        $this->load($params);
        $query->alias('p');
        $query->addSelect(['p.*', 'getImageSrc("'. \common\models\UploadForm::getUserTypePathApi() .'", p.user_id) as profilePic']);
        $query->andFilterCompare("name", $this->name);
        // add conditions that should always apply here
        if($this->name) {
            $query->orFilterWhere(['LIKE', 'p.name', $this->name]);
            $query->orFilterWhere(['LIKE', 'p.public_email', $this->name]);
            $query->orFilterWhere(['LIKE', 'p.profile', $this->name]);
            $query->orFilterWhere(['LIKE', 'p.enrollment_number', $this->name]);
            $query->orFilterWhere(['LIKE', 'p.membership_number', $this->name]);
            $query->orFilterWhere(['LIKE', 'p.landline', $this->name]);
            $query->orFilterWhere(['LIKE', 'p.mobile', $this->name]);
        }

        $query->joinWith(['designation as du', 'bloodGroup as bG']);
        if($as_array) $query->asArray(true);
        return  $query;
    }

    public static function getApiExecutiveList($params = [], $login_id = 0, $as_array = false){
        $model= new self();
        $query = $model->getQueryDataProvider($params, $login_id, $as_array)->orderBy(["weight" => SORT_DESC]);
        return new ActiveDataProvider([
            'query' => $query->andWhere(['executive' => 1])->limit(100)
        ]);
    }
    
    public static function getApiMemberList($params = [], $login_id = 0, $as_array = false){
        $model = new self;
        $query = $model->getQueryDataProvider($params, $login_id, $as_array)->orderBy(["name" => SORT_ASC]);
         
        $query->leftJoin("auth_assignment aA", ['and','aA.user_id','p.user_id', ['!=','aA.item_name','admin'], ['!=','aA.item_name','author']]);
        
        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }
    
    

}