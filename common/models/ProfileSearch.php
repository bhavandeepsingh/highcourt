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
    public function search($params = [], $login_id = 0, $as_array = false)
    {
        $query = Profile::find();

        $query->addSelect(['*', 'getImageSrc("'. \common\models\UploadForm::getUserTypePathApi() .'", user_id) as profilePic']);

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

        if($as_array) $query->asArray(true);

        return $dataProvider;
    }

    public static function getApiList($params = [], $login_id = 0, $as_array = false){
        $model = new ProfileSearch();
        return $model->search($params, $login_id, $as_array);
    }
        

}
