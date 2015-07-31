<?php
/* @var $tariffs string [] */
?>

<table class="table tariff-table">
    <thead>
        <tr>
            <?php foreach($tariffs as $tariff): ?>
                <th>от <?=$tariff['threshold']['name']?> шт.</th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php foreach($tariffs as $tariff): ?>
                <td class="price">
                    <span class="display-price"><?=$tariff['price']?> <i class="fa fa-rub"></i></span>
                </td>
            <?php endforeach; ?>
        </tr>
    </tbody>
</table>