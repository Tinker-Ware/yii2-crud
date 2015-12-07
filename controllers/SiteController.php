<?php

namespace app\controllers;

use Yii;
use yii\helpers\Markdown;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'view' => [
                'class' => \yii\web\ViewAction::className(),
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}
