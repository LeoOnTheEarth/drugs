<?php
echo $this->Html->script('c/drugs/index', array('inline' => false));
?>
<h2>藥物證書</h2>
<div class="paginator-wrapper">
    <?php echo $this->element('paginator'); ?>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <ul class="media-list">
            <p>&nbsp;</p>
            <?php
            $i = 0;
            foreach ($items as $item) {
                $name = $item['License']['name'];
                if (!empty($item['License']['name_english'])) {
                    $name .= " <br class=\"hidden-md hidden-lg\"><small class=\"text-english-name hidden-xs\">{$item['License']['name_english']}</small>";
                }
            ?>
            <li class="media">
                <div class="media-left media-middle">
                    <a href="<?php echo $this->Html->url('/') . 'drugs/view/' . $item['Drug']['id']; ?>">
                        <?php if (!empty($item['License']['image'])) { ?>
                            <img src="<?php echo $this->Html->url('/') . $item['License']['image']; ?>" class="img-thumbnail drug-list-thumbnail" />
                        <?php } else {?>
                            <div class="img-thumbnail drug-list-thumbnail">
                                <p>沒有影像</p>
                            </div>
                        <?php } ?>
                    </a>
                </div>
                <div class="media-body">
                    <a href="<?php echo $this->Html->url('/') . 'drugs/view/' . $item['Drug']['id']; ?>">
                        <h6 class="media-heading"><?php echo $name; ?></h6>
                    </a>
                    <hr>
                    <p>
                        <div class="hidden-xs"><strong>許可證字號</strong> <?php echo $item['License']['license_id']; ?><br></div>
                        <strong>製造商</strong> <?php echo $item['Vendor']['name'] . '&nbsp;' . $this->Olc->showCountry($item['Vendor']['country']); ?>
                        <br>
                        <?php
                            $now_date = new DateTime();
                            $expired_date = new DateTime($item['License']['expired_date']);
                            $date_between = intval($expired_date->diff($now_date)->y);
                        ?>
                        <strong>許可證有效日期</strong>&nbsp;
                        <?php
                            if ($date_between >= 3) {
                                echo $item['License']['expired_date'];
                            } else {
                                echo $this->Html->tag('span', $item['License']['expired_date'], array('class' => 'text-warning'));
                            }
                        ?>
                    </p>
                </div>
            </li>
            <?php }; // End of foreach ($items as $item) {  ?>
            <div class="clearfix"></div>
        </ul>
    </div>
</div>

<div class="paginator-wrapper">
    <?php echo $this->element('paginator'); ?>
</div>
