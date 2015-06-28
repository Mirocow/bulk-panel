<?php
/* @var $tariffs string[] */
?>
<h1 class="page-title">
    Тарифы
</h1>
<div class="row">
    <div class="col-md-4">
        <table class="table tariff-table">
            <thead>
                <tr>
                    <th class="col-md-3"></th>
                    <th class="col-md-3">Цена</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($tariffs as $service): ?>
                <tr>
                    <th class="service-name"><?=$service['name']?></th>
                    <?php if(isset($service['tariff'])): ?>
                        <td class="price">
                            <span class="display-price"><?=$service['tariff']['price']?> <i class="fa fa-rub"></i></span>
                        </td>
                    <?php else: ?>
                        <td></td>
                    <?php endif; ?>
                </tr>
                <?php if(isset($service['countries'])): ?>
                    <?php foreach($service['countries'] as $country): ?>
                        <tr>
                            <th class="country-name"><?=$country['name']?></th>
                            <?php if(isset($country['tariff'])): ?>
                                <td class="price">
                                    <span class="display-price"><?=$country['tariff']['price']?> <i class="fa fa-rub"></i></span>
                                </td>
                            <?php else: ?>
                                <td></td>
                            <?php endif; ?>
                        </tr>
                        <?php if(isset($country['operators'])): ?>
                            <?php foreach($country['operators'] as $operator): ?>
                                <tr>
                                    <th class="operator-name display-operator"><?=$operator['name']?></th>
                                    <?php if(isset($operator['tariff'])): ?>
                                        <td class="price">
                                            <span class="display-price"><?=$operator['tariff']['price']?> <i class="fa fa-rub"></i></span>
                                        </td>
                                    <?php else: ?>
                                        <td></td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>