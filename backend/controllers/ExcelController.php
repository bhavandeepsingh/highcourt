<?php
/* @abr */

namespace backend\controllers;

use Yii;
use common\models\Excel;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use common\models\User;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

set_time_limit(2500);
/**
 * SettingsController implements the CRUD actions for Settings model.
 */
class ExcelController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ]
                ],
            ],
        ];
    }

    /**
     * Lists all Settings models.
     * @return mixed
     */
    public function actionIndex()
    {
       //  Yii::$app->basePath."/data.xls";
         $fileName = \Yii::getAlias('@webroot')."/data.xls";

        $objPHPExcel = \PHPExcel_IOFactory::load($fileName);
        $sheetData = array_slice($objPHPExcel->getActiveSheet()->toArray(null, true, true, true),1);
        echo "<pre>";
        //print_r($sheetData);
        $i = 1;
        foreach($sheetData as $row)
        {
            $row      = array_map("trim",$row);
            
            if(!empty($row["G"]))
            {
                $mobile = str_replace("-", "", $row["G"]);
                $mobile = explode(',', $mobile);
                $mobile = $mobile[0];
            }
            else
            {
                $mobile = 9999999999;
            }

            if (!empty($row["D"])) 
            {
                $username =  $row["D"];                
            }
            elseif(!empty($row["G"]))
            {
                $username = $mobile;
            }
            elseif(empty($row["G"]) && !empty($row["H"]))
            {
                $username = $this->emailize($row["A"]);
            }
            if (!empty($row["H"])) 
            {
                
                $email = $row["H"];
                $email = explode(',', $email);

              

                $email = $email[0];

                
            }
            else
            {
               $email =  $this->emailize($row["A"]);
            }
          

            $user_data["User"]= array("username"=>$username,"email"=>$email,"mobile"=>$mobile,"password"=>"");
 
            $new_user= new User();

            $ex_data = array();

            $ex_data['name']= $row['B'];
            $ex_data['address']= $row['E'];
          


            if ($new_user->load($user_data) && $new_user->insert_import_data($ex_data))
            {      
               echo "<p style=' background: #9eaf01;padding: 10px 10px; margin: 0; border: 1px solid rgba(0,0,0,0.06); color: #ffffff;'># ($i) <span style='background:#474f01; padding:6px 10px; border-radius:25px'> ".$row['B']." </span> Account created successfully! </>";
               echo "<script type='text/javascript'>window.scrollTo(0,document.body.scrollHeight);</script>";
               ob_flush();
               flush();
                $i++;
            }
            else
            {
                echo "<p style=' background: #f45c42;padding: 10px 10px; margin: 0; border: 1px solid rgba(0,0,0,0.06); color: #ffffff;'>";
                print_r($user_data);
                echo "<br>";
                print_r($new_user->getErrors());

                echo "</p>";
            }



            

        }
        die;
    }

    /**
     * Displays a single Settings model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Settings model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function emailize($text)
    {
        
        return "test@".rand(99,99999).".com";
    }

    public function actionCreate()
    {
        $fileName = "/var/www/html/import_users/user.xls";
        //die;
        $objPHPExcel = \PHPExcel_IOFactory::load($fileName);
        $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
        echo "<pre>";
        //print_r($sheetData);
        foreach($sheetData as $row){
            $username=$row["C"];
            $email = $row["G"];
            if(empty($row["C"])){  // if enrollment number is empty
                $username = $row["G"];
            }
            if(empty($row["G"])){  // if enrollment number is empty
                $username = $row["F"];

                $email =  $this->emailize($row["A"]);
            }

            $user_data= array("username"=>$username,"email"=>$row["G"]);
            print_r($user_data);
             
            $new_user= new User();
            /*if ($new_user->load($user_data) ){

            }*/
                   //$new_user->insert_import_data($row);
            

        }

        die;
    }

    /**
     * Updates an existing Settings model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Settings model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Settings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Settings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Settings::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
