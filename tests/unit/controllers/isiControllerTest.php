<?php

namespace tests\unit\controllers;
 use app\controllers\Mahasiswa\IsiController;
 use app\models\KelasKuliah;
 use Yii;


 class isiControllerTest extends \Codeception\Test\Unit
{

    private $controller;
    public function testLoopingTotalSks()
    {

        $this->controller = new \app\controllers\Mahasiswa\IsiController('IsiController',Yii::$app);

        $test = $this->controller->actionKrs(11);



    }

    public function testSksKrs(){
        $this->controller = new \app\controllers\Mahasiswa\IsiController('IsiController',Yii::$app);

        $test = $this->controller->actionKrs(11);

    }

    public function testIdKelasKrs(){
        $this->controller = new \app\controllers\Mahasiswa\IsiController('IsiController',Yii::$app);


        $test = $this->controller->actionKrs(11);

    }

    public function testSksMelebihiSksMax(){
        $this->controller = new \app\controllers\Mahasiswa\IsiController('IsiController',Yii::$app);

        $test = $this->controller->actionKrs(11);

    }

    public function testBerhasilInputKRS(){
        $this->controller = new \app\controllers\Mahasiswa\IsiController('IsiController',Yii::$app);

        $test = $this->controller->actionKrs(11);

    }

    public function testModelKelasMelebihiKuota(){
        $this->controller = new \app\controllers\Mahasiswa\IsiController('IsiController',Yii::$app);

        $test = $this->controller->actionKrs(11);

    }
}