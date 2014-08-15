<?php

/**
 * This is the model class for table "{{comment}}".
 *
 * The followings are the available columns in table '{{comment}}':
 * @property integer $id
 * @property string $content
 * @property integer $create_time
 * @property integer $author_id
 * @property integer $post_id
 *
 * The followings are the available model relations:
 * @property Post $post
 */
class Comment extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{comment}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('content', 'required'),
            array('create_time, author_id, post_id', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, content, create_time, author_id, post_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'post' => array(self::BELONGS_TO, 'Post', 'post_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'content' => 'Content',
            'create_time' => 'Create Time',
            'author_id' => 'Author',
            'post_id' => 'Post',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('create_time', $this->create_time);
        $criteria->compare('author_id', $this->author_id);
        $criteria->compare('post_id', $this->post_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Comment the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    protected function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->create_time = time();
                $this->author_id = Yii::app()->user->id;
            }
            return true;
        } else
            return false;
    }

    public function getCommentById($id) {
        return new CActiveDataProvider($this, array(
            'criteria' => array(
                'condition' => "post_id =  $id", "order" => "create_time DESC"),
        ));
    }

    public function getCountComment($id) {
        return $count = Comment::model()->count(array(
            'select' => 'id',
            'condition' => 'post_id=:id',
            'params' => array(':id' => $id),
        ));
    }
    
    public function getLastFiveComment() {
        return $count = Comment::model()->findAll(array(
            'select' => '*',
            "order" => "id DESC LIMIT 5",
        ));
    }
    
    public function getAuthor($id){
        $author = new User;
        return $author->getAuthorById($id);
    }
    
    public function getPostTitle($id) {
        $title = new Post;
        return $title->getTitleById($id);
    }

}
