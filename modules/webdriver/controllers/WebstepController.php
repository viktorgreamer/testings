<?php

namespace app\modules\webdriver\controllers;

use app\modules\webdriver\models\Algorithm;
use Yii;
use app\modules\webdriver\models\Webstep;
use app\modules\webdriver\models\WebstepSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WebstepController implements the CRUD actions for Webstep model.
 */
class WebstepController extends Controller
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
        ];
    }

    /**
     * Lists all Webstep models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WebstepSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Webstep model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Webstep model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_algorithm = 0)
    {
        $model = new Webstep();
        if ($id_algorithm) {
            $model->id_algorithm = $id_algorithm;
           $model->priority =  Webstep::find()
                   ->where(['id_algorithm' => $id_algorithm])
                   ->andWhere(['<>', 'type', Webstep::EXCEPTION_TYPE])
                   ->max('priority') + 1;
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->type == Webstep::EXCEPTION_TYPE) {
                // высисляем максимальный приоритет данного исключения
                $model->priority =  Webstep::find()
                        ->where(['id_algorithm' => $id_algorithm])
                        ->andWhere(['name' => $model->name])
                        ->andWhere(['type' => Webstep::EXCEPTION_TYPE])
                        ->max('priority') + 1;
            }
        } if ( $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Webstep model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Webstep model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Webstep model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Webstep the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Webstep::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionChangePriority($id, $direction, $id_algorithm)
    {
        // $algorithm = Algorithm::findOne($id_algorithm);
        if ($direction == 'up') {
            $step_up = Webstep::find()->where(['id_algorithm' => $id_algorithm])->andWhere(['id' => $id])->one();
            if ($step_up->priority != 1) {
                $step_up->priority = $step_up->priority - 1;
                $step_down = Webstep::find()->where(['id_algorithm' => $id_algorithm])->andWhere(['priority' => $step_up->priority])->one();
                $step_down->priority = $step_down->priority + 1;
                $step_up->save();
                $step_down->save();
            }

        } else {
            $step_down = Webstep::find()->where(['id_algorithm' => $id_algorithm])->andWhere(['id' => $id])->one();
            $max = Webstep::find()->where(['id_algorithm' => $id_algorithm])->max('priority');
            if ($step_down->priority != $max) {
                $step_down->priority = $step_down->priority + 1;
                $step_up = Webstep::find()->where(['id_algorithm' => $id_algorithm])->andWhere(['priority' => $step_down->priority])->one();
                $step_up->priority = $step_up->priority - 1;
                $step_up->save();
                $step_down->save();
            }

        }
        return $this->render('test');
    }
}
