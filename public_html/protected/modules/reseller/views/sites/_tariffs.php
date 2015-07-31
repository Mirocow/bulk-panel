<?php
/* @var $this Controller */
/* @var $mode string */
/* @var $tariffs string[] */

if($mode == 'create')
    $viewName = '_subtariff_create';
else
    $viewName = '_subtariff_view';
?>
<?php foreach($tariffs as $service): ?>
    <h3 class="page-title"><i class="<?=$service['class']?>" style="color: #<?=$service['color']?>"></i> <?=$service['name']?></h3>
    <?php if(isset($service['tariff'])): ?>
        <?php $this->renderPartial($viewName, ['tariffs' => $service['tariff']]); ?>
    <?php endif; ?>
    <?php if(isset($service['countries'])): ?>
        <?php foreach($service['countries'] as $country): ?>
            <div class="row">
                <div class="col-md-12">
                    <b><?=$country['name']?></b>
                </div>
            </div>
            <?php if(isset($country['tariff'])): ?>
                    <?php $this->renderPartial($viewName, ['tariffs' => $country['tariff']]); ?>
            <?php endif; ?>
            <?php if(isset($country['operators'])): ?>
                <?php foreach($country['operators'] as $operator): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <i><?=$operator['name']?></i>
                        </div>
                    </div>
                    <?php if(isset($operator['tariff'])): ?>
                        <?php $this->renderPartial($viewName, ['tariffs' => $operator['tariff']]); ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
<?php endforeach; ?>
