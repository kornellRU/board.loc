<?php

namespace app\modules\profile\controllers;

use app\modules\profile\models\ImageUpload;
use Yii;
use app\modules\profile\models\Ads;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Url;

/**
 * AdController implements the CRUD actions for Ads model.
 */
class AdController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Ads models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (\Yii::$app->user->isGuest) {
            Yii::$app->getSession()->setFlash('error', 'Авторизуйтесь пожалуйста');
            return $this->redirect(Url::toRoute('/login'));
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Ads::find()->where(['author_id' => Yii::$app->user->id]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ads model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (\Yii::$app->user->isGuest) {
            Yii::$app->getSession()->setFlash('error', 'Авторизуйтесь пожалуйста');
            return $this->redirect(Url::toRoute('/login'));
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Ads model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (\Yii::$app->user->isGuest) {
            Yii::$app->getSession()->setFlash('error', 'Авторизуйтесь пожалуйста');
            return $this->redirect(Url::toRoute('/login'));
        }
        $model = new Ads();
        $model->author_id = Yii::$app->user->id;
        $images = new ImageUpload();
        $transaction = Yii::$app->db->beginTransaction();
        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->save())
            {
                $images->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
                if (!$images->validate()) {
                    Yii::$app->getSession()->setFlash('error', 'Ошибка: Не соответствующий формат изображения');
                    $transaction->rollBack();
                }
                if ($images->upload($model)) {
                    $transaction->commit();
                    Yii::$app->getSession()->setFlash('success', 'Объявление добавлено');
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }else{
                $transaction->rollBack();
            }
        }else{
            $transaction->rollBack();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Ads model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (\Yii::$app->user->isGuest) {
            Yii::$app->getSession()->setFlash('error', 'Авторизуйтесь пожалуйста');
            return $this->redirect(Url::toRoute('/login'));
        }
        $model = $this->findModel($id);
        if (!\Yii::$app->user->can('UpdateAd', ['article' => $model])) {
            Yii::$app->getSession()->setFlash('error', 'У вас нет прав на это действие');
            return $this->redirect(['/profile/ad']);
        }
        $images = new ImageUpload();
        $transaction = Yii::$app->db->beginTransaction();
        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->save())
            {
                $images->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
                if (!$images->validate()) {
                    Yii::$app->getSession()->setFlash('error', 'Ошибка: Не соответствующий формат изображения');
                    $transaction->rollBack();
                }
                if ($images->upload($model)) {
                    $transaction->commit();
                    Yii::$app->getSession()->setFlash('success', 'Объявление отредактировано');
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }else{
                $transaction->rollBack();
            }
        }else{
            $transaction->rollBack();
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Ads model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (\Yii::$app->user->isGuest) {
            Yii::$app->getSession()->setFlash('error', 'Авторизуйтесь пожалуйста');
            return $this->redirect(Url::toRoute('/login'));
        }
       $model =  $this->findModel($id);
        if (!\Yii::$app->user->can('DeleteAd', ['article' => $model])) {
            Yii::$app->getSession()->setFlash('error', 'У вас нет прав на это действие');
            return $this->redirect(['/profile/ad']);
        }
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Ads model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ads the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ads::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
