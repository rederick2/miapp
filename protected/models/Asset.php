<?php
/**
 * class User
 * @author Igor Ivanović
 * 
 */
class Asset extends CActiveRecord
{
    /**
     * Table name
     * @return string 
     */
    public function tableName() 
    {
        return 'assets';
    }
    
    public function relations()
    {
        return array(
            //'asset'=>array(self::HAS_ONE, 'Timeline', 'id_asset'),
            //'dates'=>array(self::HAS_MANY, 'Date', 'id_asset'),
        );
    }

    
}
