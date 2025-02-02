<?php foreach ($model->suggestionConstructor as $suggestionConstructor): ?>
    <div class="exercise_check suggestion_check">
        <div class="suggestion">
            <div class="beginState">
                <?php foreach ($suggestionConstructor->partsSuggestion as $partsSuggestion): ?>
                    <span class="click_word click_word_template"><?= $partsSuggestion->text; ?></span>
                <?php endforeach; ?>
            </div>
            <div class="result"
                 data-id-full-text='<?= $suggestionConstructor->id; ?>'></div>
        </div>
    </div>
<?php endforeach; ?>

<?php
$script = <<< JS
    $(document).on('click', ".click_word", function (e) {
        
        let context = $(e.target).parents('.suggestion')
        $(e.target).addClass('inResult')
        context.find('.result').append('<div class= "click_word_template inResult" > ' + $(e.target).text() + ' </div>');
        $(e.target).remove()      
        ///передаём контекст, если там не остаётся слов, то ajax передаём проверку
         
         checkStr(context)
    })


    $(document).on('click', ".inResult", function (e) {
        let context = $(e.target).parents('.suggestion');
        context.find('.beginState').append('<div class= "click_word_template click_word" > ' + $(e.target).text() + ' </div>');
        $(e.target).remove()        
    })
    
    
    
    function checkStr(context)
    {
        let elCount = context.find('.beginState .click_word_template').length,
        str = '',
        dataFullTextId = context.find('.result').attr('data-id-full-text')
        ;
        
        if(elCount==0){
             //если в .beginState 0 элементов, то отправляем строку на проверку
                    context.find('.result .click_word_template').each(function (i, val) {     
                   
                    var text = $.trim($(val).text());
                    str = str + ' ' + text
                })
                    
                    let data= {
                        str:str,
                        dataFullTextId:dataFullTextId,
                    };
                    
                if(str.length>0 && elCount==0){
                   $.ajax({
                               url: '/type_exercises/suggestion_constructor/ajax/check-full-suggestion',
                               method: "post",
                               dataType: "json",
                               data: data,
                               
                              success: function (data) {
                                   if(data.success){
                                       changeColorText(context, '.result', 'green')
                                   } else {
                                       console.log('notSuccess');
                                        changeColorText(context, '.result', 'red')
                                   }
                                    
                              }
                           });    
                }
         } 
     
        function changeColorText(context, el, color) 
        {
          $(context).find(el).css({color:color})
        }
        
        
         $('.suggestion_check').on('suggestion_check', function(e) {
                console.log('te');
         })
        
        $('.suggestion_check').bind('suggestion_check');
        
    }
JS;
//маркер конца строки, обязательно сразу, без пробелов и табуляции
$this->registerJs($script, yii\web\View::POS_READY);
?>

<style>
    .click_word_template {
        padding: 5px;
        display: inline-block;
        cursor: pointer;
    }

    .wrong {
        color: red;
    }

    .success {
        color: green;
    }
</style>