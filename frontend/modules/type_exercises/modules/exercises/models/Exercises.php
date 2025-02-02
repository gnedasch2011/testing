<?php

namespace frontend\modules\type_exercises\modules\exercises\models;

use frontend\modules\type_exercises\models\TypeExercises;
use Yii;

/**
 * This is the model class for table "exercises".
 *
 * @property int $id
 * @property string $type_exercises_id
 * @property string $name
 * @property int $id_exercises_diff
 * @property int $tasks_id
 * @property string $position
 */
class Exercises extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'exercises';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_exercises_id', 'tasks_id'], 'required'],
            [['id_exercises_diff', 'tasks_id','position'], 'integer'],
            [['type_exercises_id', 'name'], 'string', 'max' => 450],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_exercises_id' => 'Тип упражнения',
            'name' => 'Общее описание группы упражнений',
            'id_exercises_diff' => 'Id Упражнения',
            'tasks_id' => 'Какой день',
            'position' => 'Позиция',
        ];
    }
    
    public function getTypeExcercise()
    {
        return TypeExercises::returnAttrValue($this->type_exercises_id, 'name');
    }
    
}
