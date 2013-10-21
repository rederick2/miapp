<?php
/**
 * class User
 * @author Igor Ivanović
 * 
 */
class Timeline extends CActiveRecord
{
    /**
     * Table name
     * @return string 
     */
    public function tableName() 
    {
        return 'timelines';
    }
    
    public function relations()
    {
        return array(
            'asset'=>array(self::HAS_ONE, 'Asset', 'id_asset'),
            'date'=>array(self::HAS_MANY, 'TimelineDate', 'id_timeline'),
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

    public static function getTimeline( $id )
    {



        $timeline = self::model()->find( 'id_timeline=?', array($id) );

        
        if($timeline instanceof timeline)
        {
            return $timeline;
        }
        
        return NULL;
        
    }    

    
}
