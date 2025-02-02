<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\type_exercises\modules\sentence\models\SentenceCheck;

$SentenceCheck = new SentenceCheck();
?>
<?php foreach ($model->sentence as $sentence): ?>
    <div class="exercise_check sentence_check">
        <div class="sentence_item" data-id-sentence="<?= $sentence->id; ?>">
            <h3> <?= $sentence->desc; ?></h3>
            <p>Используйте данные фразы</p>
            <div>
                <ul class="sentence_item_expressions">
                    <?php foreach ($sentence->expressions as $expression): ?>
                        <li><span class="expression_item"><?= $expression->expressions; ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <?php
            $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['class' => 'form-horizontal'],
            ]) ?>
            <?= $form->field($SentenceCheck, 'text', ['options' => []])->textarea([
                'value' => 'iland I hate poison',
                'class' => 'check_sentence form-control',
            ]) ?>
            <?php ActiveForm::end() ?>
        </div>
    </div>
<?php endforeach; ?>

<?php
$script = <<< JS

            function searchText(needle, haystack)
            {      
                if(haystack.indexOf(needle)== -1){
                    return false;
                } else {
                    return true;
                }
            }
            
            function checkErrors(errors)
            {
                // checks whether an element is even
                let even = (error) => error===false;
                
                if(errors.some(even)){
                    return false;
                }
                  return true;
            }
            /**
            * Проверка каждой строки
            * @param context
            * @returns {boolean}
            */
            function checkTextInSentence(context)
            {
                let expressions = context.find('.sentence_item_expressions li'), 
                    textForCheck = context.find('.check_sentence').val()       
                    errors = []          
                    ;
                //проверяем каждую фразу в тексте
                expressions.each(function(i, val) {                    
                    if(!searchText($(val).text().trim(), textForCheck)){
                        errors.push(false);                       
                    } else{
                        errors.push(true);          
                    }                         
                })       
                        
               return checkErrors(errors);
                        
            }
            

            $('.sentence_check').bind('sentence_check')            
         
            $(document).on('sentence_check',function (e) {
                 let items = $('.sentence_item');
                 let errors = [];
                 
                items.each(function(i, context) {      
                    if (checkTextInSentence($(context))){
                        $(context).find('.check_sentence ').css({'border':"5px solid green"})
                    } else {
                       $(context).find('.check_sentence ').css({'border':"5px solid red"})
                    }
                 
                })  
            })
          
                   
         
          
JS;
//маркер конца строки, обязательно сразу, без пробелов и табуляции
$this->registerJs($script, yii\web\View::POS_READY);
?>