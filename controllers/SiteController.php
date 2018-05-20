<?php

namespace app\controllers;

use app\components\MyChromeDriver;
use app\models\Accounts;
use app\models\Kolmovo;
use app\models\Webstep;
use GuzzleHttp\Client;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use GuzzleHttp;
use app\components\MyCurl;
use Curl\Curl;


class SiteController extends Controller
{
    /**
     * @inheritdoc
     */


    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionForAdmin()
    {
        return $this->render('for-admin');
    }

    public function actionForUser()
    {
        return $this->render('for-user');
    }

    public function actionForEveryOne()
    {
        return $this->render('for-every-one');
    }

    public function actionConsole()
    {
        $message = 'empty';
        $user = Yii::$app->user->identity;
        $auth = Yii::$app->authManager;
        if (Yii::$app->user->isGuest) $message = 'Guest';
        else $message = $user->username;
        $roles = $auth->getRole($user);

        $permissions = $auth->getPermissions();


        return $this->render('empty', compact(['message', 'roles', 'permissions', 'rules']));
    }


    public function actionAddAdmin()
    {
        /*        $model = User::find()->where(['username' => 'simple-user'])->one();
                if (empty($model)) {
                    $user = new User();
                    $user->username = 'antuan';
                    $user->email = 'admin@коkqsqдер.укр';
                    $user->setPassword('user');
                    $user->generateAuthKey();
                    if ($user->save()) {
                        echo 'good';
                    }
                }*/
    }


    public function actionCurl()
    {
        $curl = new Curl();

        $curl->setHeaders(
            [
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
                'Accept-Encoding' => 'gzip, deflate, br',
                'Accept-Language' => 'ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7,es;q=0.6',
                'DNT' => '1',
                'Referer' => 'https://novgorod.cian.ru/cat.php?deal_type=sale&engine_version=2&offer_type=flat&region=4694&room1=1&room2=1',
                'Upgrade-Insecure-Requests' => '1',
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36'
            ]
        );


        $curl->get('https://novgorod.cian.ru/kupit-1-komnatnuyu-kvartiru/');

        if ($curl->error) {
            echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
        } else {
            echo 'Response:' . "\n";
            // var_dump($curl->response);
        }

        echo gzdecode($curl->response);

        return $this->render('debug');


    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionTestChrome($id_algorithm = 1)
    {
        echo "<BR>";
        echo "<BR>";
        echo "<BR>";
        echo span("<br> TEST CHROME AUTOMATISATION", 'success');
        echo span("<br> OPEN DRIVER", 'success');
        $driver = MyChromeDriver::Open();
        $models = Kolmovo::find()->all();
        foreach ($models as $model) {
            sleep(3);
            $driver->model = $model;
            $driver->processingnew($id_algorithm);
        }

        sleep(10);
        $driver->quit();
        return $this->render('test');

    }

    public function actionVkontakte($id_algorithm = 2)
    {
        echo "<BR>";
        echo "<BR>";
        echo "<BR>";
        echo span("<br> TEST CHROME AUTOMATISATION", SUCCESS);
        echo span("<br> OPEN DRIVER", SUCCESS);
        $driver = MyChromeDriver::Open();
        $driver->model = Accounts::find()->where(['id' => 2])->one();
        $driver->processingnew($id_algorithm);
        sleep(10);
        //  $driver->quit();
        return $this->render('test');

    }

    public function actionTest()
    {


    }

    public function actionYandex($id_algorithm = 3)
    {
        echo "<BR>";
        echo "<BR>";
        echo "<BR>";
        echo span("<br> TEST CHROME AUTOMATISATION", 'success');
        echo span("<br> OPEN DRIVER", 'success');
        $driver = MyChromeDriver::Open();
        $driver->model = Accounts::find()->where(['id' => 3])->one();
        $driver->processingnew($id_algorithm);
        sleep(10);
        //  $driver->quit();
        return $this->render('test');

    }

    public function actionFirefox($id_algorithm = 2)
    {
        echo "<BR>";
        echo "<BR>";
        echo "<BR>";
        echo span("<br> TEST CHROME AUTOMATISATION", 'success');
        echo span("<br> OPEN DRIVER", 'success');
        $driver = MyChromeDriver::Open('', 'firefox');
        $driver->model = Accounts::find()->where(['id' => 2])->one();
        $driver->processingnew($id_algorithm);
        sleep(10);
        //  $driver->quit();
        return $this->render('test');

    }

    public function actionGuzzle()
    {
        echo "<BR>";
        echo "<BR>";
        echo "<BR>";
        info('GUZZLE');

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://novgpm.ru/',
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);
        $response = $client->get('http://novgpm.ru/', ['allow_redirects' => false], ['user-agent' => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36']);
        echo $response->getBody();


        return $this->render('test');
    }


}
