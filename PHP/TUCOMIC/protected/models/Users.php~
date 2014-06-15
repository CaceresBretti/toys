<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $id
 * @property string $name
 * @property string $password
 * @property string $facebook
 * @property string $rol
 * @property string $email
 * @property string $telefono
 * @property integer $reputacion
 * @property string $foto
 */
class Users extends CActiveRecord
{

	//ENTREGA UNA LISTA CON TODOS LOS ADMINISTRADORES
	public function GetAdmins(){
		$connection=Yii::app()->db;
		$command= $connection->createCommand("SELECT name FROM Users WHERE rol=1");
		//$rows = $command->queryRow();
		$rows = array();
		$dataReader=$command->query();
		while(($row=$dataReader->read())!==false){
			array_push($rows, $row['name']);
		}
		return $rows;
	}



	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}
	protected function beforeSave() {
       $this->password = sha1($this->password);
       return parent::beforeSave();
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('reputacion', 'numerical', 'integerOnly'=>true),
			array('name, password, facebook, rol, email, telefono, foto', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, password, facebook, rol, email, telefono, reputacion, foto', 'safe', 'on'=>'search'),
			//FILE FOTO	
			array('foto', 'file', 'types'=>'jpg, gif, png'),
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
			'id' => 'ID',
			'name' => 'Name',
			'password' => 'Password',
			'facebook' => 'Facebook',
			'rol' => 'Rol',
			'email' => 'Email',
			'telefono' => 'Telefono',
			'reputacion' => 'Reputacion',
			'foto' => 'Foto',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('facebook',$this->facebook,true);
		$criteria->compare('rol',$this->rol,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('reputacion',$this->reputacion);
		$criteria->compare('foto',$this->foto,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
