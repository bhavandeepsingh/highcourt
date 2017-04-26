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
    public function rules()
    {
        return [
            [['user_id', 'designation', 'executive'], 'integer'],
            [['name', 'public_email', 'gravatar_email', 'gravatar_id', 'location', 'website', 'bio', 'timezone','profile','enrollment_number','membership_number','landline','mobile','residential_address','court_address','blood_group','lat1','long1','lat2','long2'], 'safe'],
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
        $query = Profile::find();

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
       /* $query->andFilterWhere([
            'user_id' => $this->user_id,
            'designation' => $this->designation,
            'executive' => $this->executive,
            
        ]);
'name', 'public_email', 'gravatar_email', 'gravatar_id', 'location', 'website', 'bio', 'timezone',
        * 'profile','enrollment_number','membership_number','landline','mobile',
        * 'residential_address','court_address','blood_group','lat1','long1','lat2','long2'
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'enrollment_no', $this->enrollment_no])
            ->andFilterWhere(['like', 'membership_no', $this->membership_no])
            ->andFilterWhere(['like', 'email_id', $this->email_id])
            ->andFilterWhere(['like', 'landline_no', $this->landline_no])
            ->andFilterWhere(['like', 'mobile_no', $this->mobile_no])
            ->andFilterWhere(['like', 'residential_address', $this->residential_address])
            ->andFilterWhere(['like', 'court_address', $this->court_address]);*/

        return $dataProvider;
    }
     public static function getApiList($params = [], $login_id = 0, $as_array = false){
        $model = new ProfileSearch();
        return $model->search($params, $login_id, $as_array);
    }
    
    public static function editApiUser(){
        return "qwe1";
    }
}
