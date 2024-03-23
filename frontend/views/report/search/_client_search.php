<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<?php ActiveForm::begin(['method'=>'get']);?>
<div class="row">
    <div class="form-group col-md-4">
        <label for="fullname">Имя Клиента</label>
        <input type="text" id="fullname" class="form-control" name="Client[fullname]">
    </div>
    <div class="form-group col-md-4">
        <label for="phone">Номер телефона</label>
        <input type="text" id="phone" class="form-control" name="Client[phone]">
    </div>
    <div class="col-md-2 form-group mt-4">
        <a href="<?=Url::to(['clients'])?>" class="btn btn-outline-secondary w-100">
            Сбросить
        </a>
    </div>
    <div class="col-md-2 form-group mt-4">
        <button type="submit" class="btn btn-success w-100"><i class="bi bi-search"></i> Поиск</button>
    </div>
</div>
<?php ActiveForm::end()?>


