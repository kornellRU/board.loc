<?php
/**
 * Created by PhpStorm.
 * User: kornell
 * Date: 01.06.18
 * Time: 0:51
 */

namespace app\controllers;


use yii\web\Controller;
use app\models\Ads;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;


class AdController extends Controller
{

    public function actionIndex()
    {
        $query = Ads::find()->with('images')->orderBy(['id' => SORT_DESC,]);
        $pages = new Pagination(['totalCount'=> $query->count(), 'pageSize' => 5, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $posts = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index', ['posts' => $posts, 'pages' => $pages]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', ['model' => $model]);
    }

    protected function findModel($id)
    {
        if (($model = Ads::find()->with('images')->where('id=:id')->addParams([':id' => $id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}