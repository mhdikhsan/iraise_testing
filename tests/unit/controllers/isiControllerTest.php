<?php

namespace tests\unit\controllers;
 use app\controllers\Mahasiswa\IsiController;
 use Yii;


 class isiControllerTest extends \Codeception\Test\Unit
{

    private $controller;
    public function testKelasKuliah()
    {

        $this->controller = new \app\controllers\Mahasiswa\IsiController('IsiController',Yii::$app);

        $test = $this->controller->actionIndex();

        expect($test)->null();

    }
}