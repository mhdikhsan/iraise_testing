<?php

class Wisuda extends CActiveRecord
{
	
	public function tableName()
	{
		return 'wisuda';
	}

	public function rules()
	{
		return array(
		);
	}

	public function relations()
	{
		return array(
			'kons'=>array(self::BELONGS_TO, 'Konsentrasi', 'wis_kons'),
			'predikat'=>array(self::BELONGS_TO, 'Predikat', 'skl_predikat'),
		);
	}

	public function attributeLabels()
	{
		return array(
		);
	}

	

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
