<?php
$sess_id_pd=Yii::app()->session->get('username');
$this->redirect(Yii::app()->request->baseUrl.'/mahasiswa/Mahasiswa/update/id/'.$sess_id_pd);