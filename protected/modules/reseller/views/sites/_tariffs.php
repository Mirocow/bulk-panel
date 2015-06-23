<?php
/* @var $tariffs string[] */
?>
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
                            <input type="text" name="Price[<?=$service['tariff']['id']?>]" class="form-control"/>
                            <span class="base-price"><?=$service['tariff']['price']?> <i class="fa fa-rub"></i></span>
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
                                    <input type="text" name="Price[<?=$country['tariff']['id']?>]" class="form-control"/>
                                    <span class="base-price"><?=$country['tariff']['price']?> <i class="fa fa-rub"></i></span>
                                </td>
                            <?php else: ?>
                                <td></td>
                            <?php endif; ?>
                        </tr>
                        <?php if(isset($country['operators'])): ?>
                            <?php foreach($country['operators'] as $operator): ?>
                                <tr>
                                    <th class="operator-name"><?=$operator['name']?></th>
                                    <?php if(isset($operator['tariff'])): ?>
                                        <td class="price">
                                            <input type="text" name="Price[<?=$operator['tariff']['id']?>]" class="form-control"/>
                                            <span class="base-price"><?=$operator['tariff']['price']?> <i class="fa fa-rub"></i></span>
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