<?php
/**
 * class Comments
 * @author Igor Ivanović
 * 
 */
class Comment extends CActiveRecord
{
    /**
     * Table name
     * @return string 
     */
    public function tableName() 
    {
        return 'comments';
    }

    public function relations()
    {
        return array(
            'user'=>array(self::BELONGS_TO, 'User', 'id_user')
        );
    }
    
     /**
     * Return current object in static 
     * @param type $className this
     * @return type object
     */
    public static function model($className = __CLASS__) 
    {
        return parent::model($className);
    }
    
    
    
}
