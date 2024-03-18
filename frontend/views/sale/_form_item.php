<?php
$lang = Yii::$app->language;

use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php $form = ActiveForm::begin(['action' => Url::to(['/new-product']),'method'=>'post']); ?>
<?= $form->field($model, 'sale_id')->textInput(['hidden' => true, 'value' => $sale_id])->label(false) ?>
<div class="row">
    <div class="col-md-3">
        <?= $form->field($model, 'product_id')->widget(Select2::class, [
            'data' => \yii\helpers\ArrayHelper::map(\common\models\Warehouse::find()->all(), 'product_id', 'info'),
            'language' => 'ru',
            'options' => [
                'placeholder' => 'Выберите продукт',
            ]
        ]) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'price')->textInput(['type' => 'number']) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'weight')->textInput(['type' => 'number','step'=>'any']) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'total_price')->textInput() ?>
    </div>
    <div class="col-md-2 mt-4">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success w-100']) ?>
    </div>
</div>

<?php ActiveForm::end();


$js = <<<JS
    $('form').on('beforeSubmit', function(){
        var data = $(this).serialize();
        $.ajax({
            url: '/new-product',
            type: 'post',
            data: data,
            success: function(res){
                console.log(res);
            },
            error: function(jqXHR, errMsg) {
            alert(errMsg);
        }
        });
        return false;
    });
JS;

//$this->registerJs($js);
?>
<script>
    let weight = document.getElementById('saleitem-weight')
    let price = document.getElementById('saleitem-price')
    let total = document.getElementById('saleitem-total_price')

    function totalScript() {
        let Total = weight.value * price.value
        total.value = Total
    }
    weight.addEventListener('change',totalScript)
</script>