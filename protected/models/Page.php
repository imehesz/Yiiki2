<?php

/**
 * This is the model class for table "pages".
 *
 * The followings are the available columns in table 'pages':
 * @property integer $id
 * @property string $title
 * @property string $body
 * @property integer $revision
 * @property integer $created
 */
class Page extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Page the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// hozzaadott szabalyaink
			array( 'title', 'required', 'message' => 'Ejnye! Cím nem lehet üres!' ),
			array( 'title', 'unique' ),
			array('title',
					'match',
					'pattern'=>'/^[A-Za-z0-9_]+$/',
					'message' => 'Jajj! Csak számokat, betűket és `_` jelet használhatsz! Bocsi' ),
			// eddig ...
			array('revision, created', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>125),
			array('body', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, body, revision, created', 'safe', 'on'=>'search'),
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
			'title' => 'Title',
			'body' => 'Body',
			'revision' => 'Revision',
			'created' => 'Created',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('revision',$this->revision);
		$criteria->compare('created',$this->created);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria
		));
	}

	function beforeSave()
	{
		$this->created = time();
		return parent::beforeSave();
	}

	public function save( $validate = true )
	{
			if( $this->isNewRecord )
			{
					// noveljuk a verzio-szamot ...
					$this->revision = $this->revision+1;
					return parent::save( $validate );
			}
			else
			{
					// ha a save fuggvenyt false-kent hivjuk meg
					// akkor a modell atugorja az ellenorzest igy nem kell a
					// a title egyenisegevel bajlodnunk, es igy noveljuk a verzio szamot
					$newpage = new Page();
					$newpage->attributes = $this->attributes;
					$newpage->save(false);
					return true;
			}
	}

}
