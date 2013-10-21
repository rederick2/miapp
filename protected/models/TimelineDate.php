<?php
/**
 * class User
 * @author Igor Ivanović
 * 
 */
class TimelineDate extends CActiveRecord
{
    /**
     * Table name
     * @return string 
     */
    public $id_timeline;

    public function tableName() 
    {
        return 'dates';
    }
    
    public function relations()
    {
        return array(
            'asset'=>array(self::BELONGS_TO, 'Asset', 'id_asset'),
            'timeline'=>array(self::BELONGS_TO, 'Timeline', 'id_timeline'),
            'user'=>array(self::BELONGS_TO, 'User', 'id_user'),
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

    public static function convertModelToArray($models) {
        if (is_array($models))
            $arrayMode = TRUE;
        else {
            $models = array($models);
            $arrayMode = FALSE;
        }

        $result = array();
        foreach ($models as $model) {
            $attributes = $model->getAttributes();
            $relations = array();
            foreach ($model->relations() as $key => $related) {
                if ($model->hasRelated($key)) {
                    $relations[$key] = self::convertModelToArray($model->$key);
                }
            }
            $all = array_merge($attributes, $relations);

            if ($arrayMode)
                array_push($result, $all);
            else
                $result = $all;
        }
        return $result;
    }

    
}
