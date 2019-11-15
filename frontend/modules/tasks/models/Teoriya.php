<?php

namespace frontend\modules\tasks\models;

use frontend\modules\admin\traits\CreateAdmitTrait;
use Yii;

/**
 * This is the model class for table "teoriya".
 *
 * @property int $id
 * @property string $text
 * @property string $template
 */
class Teoriya extends \yii\db\ActiveRecord
{

    use CreateAdmitTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teoriya';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text', 'template'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'template' => 'Template',
        ];
    }
}
