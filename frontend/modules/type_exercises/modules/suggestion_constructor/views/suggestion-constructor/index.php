<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Suggestion Constructors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="suggestion-constructor-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Suggestion Constructor', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'full_text',
            'type_exercises_id',
            'partsSuggestion',


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
