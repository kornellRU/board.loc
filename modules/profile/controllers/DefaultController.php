<?php

namespace app\modules\profile\controllers;

use app\modules\profile\models\User;
use yii\web\Controller;
use yii\filters\AccessControl;
use budyaga\users\models\forms\ChangeEmailForm;
use budyaga\users\models\forms\ChangePasswordForm;
use budyaga\users\models\forms\RetryConfirmEmailForm;
use budyaga\users\models\UserEmailConfirmToken;
use budyaga\users\models\forms\LoginForm;
use budyaga\users\models\forms\PasswordResetRequestForm;
use budyaga\users\models\forms\ResetPasswordForm;
use budyaga\users\models\forms\SignupForm;
use yii\web\UploadedFile;
use Yii;
use yii\helpers\Url;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use app\modules\profile\models\Ads;
use app\modules\profile\models\Reviews;

/**
 * Default controller for the `profile` module
 */
class DefaultController extends Controller
{
    public function actions()
    {
        return [
            'uploadPhoto' => [
                'class' => 'budyaga\cropper\actions\UploadAction',
                'url' => Yii::$app->controller->module->userPhotoUrl,
                'path' => Yii::$app->controller->module->userPhotoPath,
            ]
        ];
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionSetting()
    {
        if (\Yii::$app->user->isGuest) {
            Yii::$app->getSession()->setFlash('error', 'Авторизуйтесь пожалуйста');
            return $this->redirect(Url::toRoute('/login'));
        }
        if (!\Yii::$app->user->can('profileUpdate')) {
            Yii::$app->getSession()->setFlash('error', 'У вас нет прав на это действие');
            return $this->redirect(['/profile']);
        }
        $model = Yii::$app->user->identity;
        $changePasswordForm = new ChangePasswordForm;
        $changeEmailForm = new ChangeEmailForm;
        $transaction = Yii::$app->db->beginTransaction();
        if ($model->load(Yii::$app->request->post()))
        {

            if(!$model->imageFile = UploadedFile::getInstance($model, 'photo'))
            {
                $model->photo = $model->oldAttributes['photo'];
            }
            if ($model->save())
            {
                if ($model->imageFile) {
                    $model->upload();
                }
                $transaction->commit();
                Yii::$app->getSession()->setFlash('success', Yii::t('users', 'CHANGES_WERE_SAVED'));
                return $this->redirect(Url::toRoute('/profile'));
            }else{
                $transaction->rollBack();
                Yii::$app->getSession()->setFlash('error', 'Ошибка: Не соответствующий формат изображения');
                return $this->redirect(Url::toRoute('/profile'));
            }

        }

        if ($model->password_hash != '') {
            $changePasswordForm->scenario = 'requiredOldPassword';
        }

        if ($changePasswordForm->load(Yii::$app->request->post()) && $changePasswordForm->validate()) {
            $model->setPassword($changePasswordForm->new_password);
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('users', 'NEW_PASSWORD_WAS_SAVED'));
                return $this->redirect(Url::toRoute('/profile'));
            }
        }

        if ($changeEmailForm->load(Yii::$app->request->post()) && $changeEmailForm->validate() && $model->setEmail($changeEmailForm->new_email)) {
            Yii::$app->getSession()->setFlash('success', Yii::t('users', 'TO_YOURS_EMAILS_WERE_SEND_MESSAGES_WITH_CONFIRMATIONS'));
            return $this->redirect(Url::toRoute('/profile'));
        }


        return $this->render('profile', [
            'model' => $model,
            'changePasswordForm' => $changePasswordForm,
            'changeEmailForm' => $changeEmailForm,
        ]);
    }

    public function actionIndex($id =null)
    {
        if (\Yii::$app->user->isGuest) {
            Yii::$app->getSession()->setFlash('error', 'Авторизуйтесь пожалуйста');
            return $this->redirect(Url::toRoute('/login'));
        }
        $review = new Reviews();
        $model = (!empty($id))?(new User())->getProfileUser($id):Yii::$app->user->identity;
        return $this->render('list', [
            'model' => $model,
            'review' => $review,
        ]);
    }

    public function actionReview()
    {
        if (\Yii::$app->user->isGuest) {
            Yii::$app->getSession()->setFlash('error', 'Авторизуйтесь пожалуйста');
            return $this->redirect(Url::toRoute('/login'));
        }
        $model = new Reviews();
        $model->author_id = Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->recipient_id == $model->author_id)
            {
                Yii::$app->getSession()->setFlash('error','Ошибка! Вы не можете писать себе отзывы');

                return $this->redirect(Url::toRoute('/profile'));
            }
            if ($model->save())
            {
                Yii::$app->getSession()->setFlash('success','Отыв добавлен');

                return $this->redirect(Url::toRoute('/profile'));
            }
            Yii::$app->getSession()->setFlash('error','Ошибка! Отзыв не добавлен');

            return $this->redirect(Url::toRoute('/profile'));
        }
        Yii::$app->getSession()->setFlash('error','Ошибка! Модель не загружена.');

        return $this->redirect(Url::toRoute('/profile'));
    }
}
