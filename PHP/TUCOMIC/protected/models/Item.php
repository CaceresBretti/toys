<?php

/**
 * This is the model class for table "item".
 *
 * The followings are the available columns in table 'item':
 * @property string $nombre
 * @property string $editorial
 * @property integer $precio
 * @property string $escritor
 * @property string $dibujante
 * @property string $numero
 * @property string $saga
 * @property integer $estado
 * @property integer $id
 * @property integer $id_user
 * @property integer $condicion
 * @property integer $genero
 * @property integer $idioma
 * @property string $descripcion
 */
class Item extends CActiveRecord
{

	 public $maxid;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('precio, estado, id_user, condicion, genero, idioma', 'numerical', 'integerOnly'=>true),
			array('nombre, editorial, escritor, dibujante, numero, saga, descripcion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('nombre, editorial, precio, escritor, dibujante, numero, saga, estado, id, id_user, condicion, genero, idioma, descripcion', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'nombre' => 'Nombre',
			'editorial' => 'Editorial',
			'precio' => 'Precio',
			'escritor' => 'Escritor',
			'dibujante' => 'Dibujante',
			'numero' => 'Numero',
			'saga' => 'Saga',
			'estado' => 'Estado',
			'id' => 'ID',
			'id_user' => 'Id User',
			'condicion' => 'Condicion',
			'genero' => 'Genero',
			'idioma' => 'Idioma',
			'descripcion' => 'Descripcion',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('editorial',$this->editorial,true);
		$criteria->compare('precio',$this->precio);
		$criteria->compare('escritor',$this->escritor,true);
		$criteria->compare('dibujante',$this->dibujante,true);
		$criteria->compare('numero',$this->numero,true);
		$criteria->compare('saga',$this->saga,true);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('id',$this->id);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('condicion',$this->condicion);
		$criteria->compare('genero',$this->genero);
		$criteria->compare('idioma',$this->idioma);
		$criteria->compare('descripcion',$this->descripcion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Item the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
