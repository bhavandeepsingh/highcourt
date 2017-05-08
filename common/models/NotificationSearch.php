<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Notification;

/**
 * NotificationSearch represents the model behind the search form about `common\models\Notification`.
 */
class NotificationSearch extends Notification
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sender_id', 'reciever_id', 'created_at', 'updated_at'], 'integer'],
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
        $this->login_id = $login_id;
        
        $query = Notification::find()->alias('n');

        // add conditions that should always apply here
        
        $query->orderBy(["n.id" => SORT_DESC]);

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
            'sender_id' => $this->sender_id,
            'reciever_id' => $this->reciever_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);
        
        $query->joinWith(['isRead' => function($q){
            $q->onCondition(['nS.user_id' => $this->login_id]);
        }], false, 'LEFT JOIN');
        
        $query->addSelect(['n.*', 'getNotificationImageSrc("'.UploadForm::getNotificationTypePathApi().'", n.id, n.filename) as notification_src', 'nS.id as isRead']);
        
        if($as_array) $query->asArray(true);
        
        return $dataProvider;
    }
    
    public static function getNotifactionDataApi($params = [], $login_id = 0, $as_array = false){
        return self::getInstance()->search($params, $login_id, $as_array);
    }
    
}
