<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "payment_log".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $payment_type
 * @property string $payment_token
 * @property integer $status
 * @property string $response
 * @property integer $created_at
 * @property integer $updated_at
 */
class PaymentLog extends BaseModel
{
    public static $INIT  =   0;
    public static $SUCCESS  =   1;
    public static $ABORT    =   2;
    public static $FAILURE  =   3;
    public static $ILLEGAL  =   4;
    public static $ERROR    =   5;

    public $_user;
    
    public static $_SUBSCRIPTION_PAYMENT = 1;
    public static $_WELFAIR_PAYMENT = 2;
    
    public $subscription_log;
    
    public $welfair_log;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'payment_type', 'status'], 'integer'],
            [['response'], 'string'],
            [['subscription_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'payment_type' => 'Payment Type',
            'subscription_id' => 'Subscription Id',
            'status' => 'Status',
            'response' => 'Response',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public function getLog()
    {
        return $this->hasMany(PaymentDatetime::className(), ['payment_id' => 'id']);
    }
    
    public function getUser()
    {
        return $this->hasOne(\common\models\Profile::className(), ['user_id' => 'user_id']);
    }
    
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    
    public static function getUserLog(User $user){
        $return = "";
        $model = self::getInstance();
        $model->_user = $user;
        $return['subscription'] = $model->getPayments(self::$_SUBSCRIPTION_PAYMENT);
        $return['welfair'] = $model->getPayments(self::$_WELFAIR_PAYMENT);
        return $return;
    }
    
    public function getPayments($type){
        return [
            'log' => $this->getPaymentsLog($type, true),
            'pending_from' => $this->getPendingFrom($type),
            'pending_to' => $this->getPendingTo($type),
            'amount' => $this->_user->profile->designations->amount,
            'number_count' => $this->getNumberCount($type),
            'total_amount' => $this->getPendingAmount($type)
        ];
    }          
    
    public function getPendingFrom($type){
        return $this->getFromDate(($type == self::$_SUBSCRIPTION_PAYMENT)? $this->subscription_log: $this->welfair_log);
    }
    
    public function getPendingTo($type){
        return date('Y-m-d', time());
    }
    
    public function getNumberCount($type){
        $month = self::diffInMonths(date_create($this->getPendingFrom($type)), date_create($this->getPendingTo($type)));
        if($type == self::$_SUBSCRIPTION_PAYMENT) return $month+1;            
        else return round(($month >= 12)? ($month/12)+1 : 1);        
    }


    public function getPendingAmount($type){        
        $month = $this->getNumberCount($type);
        if($type == self::$_SUBSCRIPTION_PAYMENT){            
            return $month * $this->_user->profile->designations->amount;
        }else if($type == self::$_WELFAIR_PAYMENT){
            return $month * 200;
        }
    }
    
    public function getFromDate($data){        
        if(isset($data[0]) && isset($data[0]['log'][0]) && isset($data[0]['log'][0]['date']))
            return $data[0]['log'][0]['date'];
        else 
            return date("Y-m-d", $this->_user->created_at);
    }

    public function getPaymentsLog($type = "", $asArray = false){        
        $log = PaymentLog::find()
                ->with(['log' => function($q){
                    $q->orderBy(['date'=> SORT_DESC]);
                }])
                ->andWhere(['payment_type' => $type])
                ->asArray($asArray)->all();
        if($type == self::$_SUBSCRIPTION_PAYMENT) $this->subscription_log = $log;
        if($type == self::$_WELFAIR_PAYMENT) $this->welfair_log = $log;
        return $log;
    }
    
    public static function diffInMonths(\DateTime $date1, \DateTime $date2)
    {
        $diff =  $date1->diff($date2);

        $months = $diff->y * 12 + $diff->m + $diff->d / 30;

        return (int) round($months);
    }
}
