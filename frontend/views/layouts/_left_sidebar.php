<?php
$lang = yii::$app->language;

use yii\helpers\Url;
use yii\helpers\Html;
use common\widgets\Alert;
use cinghie\multilanguage\widgets\MultiLanguageWidget;

?>

<style>
    .accordion-button > i {
        margin-right: 15px;
    }
</style>

<?= Alert::widget() ?>
<div class="sidebar-heading text-bg-dark text-center px-1 py-1 mt-1 mb-1">
    <img src="<?= Yii::$app->request->baseUrl . '/yii2.png' ?>" alt="logo" style="width: 170px;">
    <div class="h5 mt-3" style="text-transform: none;"><?php echo Yii::$app->user->identity->fullname; ?></div>
    <table class="table table-dark table-bordered text-left text-white border-white">
        <tr>
            <td><?php echo "Курс"; ?></td>
            <td><?php
                $rate = \common\models\CurrencyRate::findOne(['status' => 0]);
                if ($rate){
                    echo Yii::$app->formatter->asDecimal($rate->amount, 0) . ' UZS';
                }else{
                    echo 0;
                }
                ?>
            </td>
        </tr>
    </table>
    <hr/>
</div>

<div class="accordion accordion-flush" id="accordionFlushExample">
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#accordionIncome" aria-expanded="false" aria-controls="accordionIncome">
                <i class="bi bi-house text-success"></i>
                <?php echo "Информация о складе" ?>
            </button>
        </h2>
        <div id="accordionIncome" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
             data-bs-parent="#accordionClients">
            <div class="accordion-body">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?php echo Url::to(['warehouse/index']); ?>"><i
                                    class="bi bi-chevron-right"></i> <?php echo "Склад" ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?php echo Url::to(['income/index']); ?>"><i
                                    class="bi bi-chevron-right"></i> <?php echo "Приход" ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingPays">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapsPays" aria-expanded="false" aria-controls="flush-collapseOne">
                <i class="bi bi-list-check text-success"></i> Заказы
            </button>
        </h2>
        <div id="flush-collapsPays" class="accordion-collapse collapse" aria-labelledby="flush-headingPays"
             data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?php echo Url::to(['sale/create']); ?>">
                            <i class="bi bi-chevron-right"></i> Новые Заказы
                        </a>
                        <a class="nav-link" aria-current="page" href="<?php echo Url::to(['sale/index']); ?>">
                            <i class="bi bi-chevron-right"></i> Список заявок
                        </a>
                        <hr>
                        <a class="nav-link" aria-current="page" href="<?php echo Url::to(['payment/index']); ?>">
                            <i class="bi bi-chevron-right"></i> Касса
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingPays">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseClient" aria-expanded="false" aria-controls="flush-collapseOne">
                <i class="bi bi-people text-success"></i> Клиенты
            </button>
        </h2>
        <div id="flush-collapseClient" class="accordion-collapse collapse" aria-labelledby="flush-headingPays"
             data-bs-parent="#accordionClients">
            <div class="accordion-body">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?php echo Url::to(['client/create']); ?>">
                            <i class="bi bi-chevron-right"></i> Новый клиент
                        </a>
                        <a class="nav-link" aria-current="page" href="<?php echo Url::to(['client/index']); ?>">
                            <i class="bi bi-chevron-right"></i> Список клиентов
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                <i class="bi bi-gear text-success"></i>
                <?php echo "Настройки" ?>
            </button>
        </h2>
        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
             data-bs-parent="#accordionClients">
            <div class="accordion-body">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?php echo Url::to(['products/index']); ?>"><i
                                class="bi bi-chevron-right"></i> <?php echo "Товары" ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?php echo Url::to(['gold-type/index']); ?>"><i
                                class="bi bi-chevron-right"></i> <?php echo "Проба" ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page"
                           href="<?php echo Url::to(['currency-rate/index']); ?>"><i
                                class="bi bi-chevron-right"></i> <?php echo "Курс" ?></a>
                    </li>
                    <hr>
                    <?php if (Yii::$app->user->identity->role_id == 0): ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="<?php echo Url::to(['user/index']); ?>"><i
                                    class="bi bi-chevron-right"></i> <?php echo "Пользователи" ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>

</div>


<footer class="container text-white text-center mt-5 mb-5 py-5">
    <br/>
    &copy; <?= date('Y') ?> Created by <br/><a href="https://resume.dyz076.ru/" class="text-white"
                                               target="_blank">D.Y</a> <br/>
    +998(99) 599-36-03<br/>

</footer>