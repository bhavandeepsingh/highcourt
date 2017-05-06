<?php
namespace common\rules;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EditorRules
 *
 * @author bhavan
 */
class EditorRules extends \yii\rbac\Rule{
    
    public $name = 'Editor';
    
    public function execute($user, $item, $params) {         
        return isset($params['post']) ? $params['post']->createdBy == $user : false;
    }

//put your code here
}
