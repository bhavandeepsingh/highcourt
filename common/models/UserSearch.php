<?php
namespace common\models;

use yii\data\ActiveDataProvider;
use dektrium\user\models\UserSearch as BaseUser;

class UserSearch extends BaseUser
{
    public $is_executive;
    
    public function rules() {
        $rules = parent::rules();
        $rules[] = [["is_executive"],"safe"];
        return $rules;
    }
    
    public function search($params)
    {
        
        $query = $this->finder->getUserQuery();
        
        if(!isset($params["sort"])){
            $query->orderBy(["created_at" => SORT_DESC]);
        }
        
        $query->joinWith(['profile']);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        
        $query->andFilterWhere(['=', 'executive', $this->is_executive]);
        
        if ($this->created_at !== null) {
            $date = strtotime($this->created_at);
            $query->andFilterWhere(['between', 'created_at', $date, $date + 3600 * 24]);
        }

        if ($this->last_login_at !== null) {
            $date = strtotime($this->last_login_at);
            $query->andFilterWhere(['between', 'last_login_at', $date, $date + 3600 * 24]);
        }

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['registration_ip' => $this->registration_ip]);
        
        return $dataProvider;
    }
}

