<div class="sp_wrap">
    <?=$this->renderLayer('main_head'); ?>
    <div class="sp_info fs-32"><?=$this->t('ok')?></div>
    <div class="sp_langs">
        <?php
        if ($this->getConfig('app', 'multilingual') == 'on') {
            foreach ($this->getConfig('langs', 'list') as $lang) {
                echo '<a href="' . $this->link($this->getPageData('clean_path'), $lang['iso']) . '" hreflang="' . $lang['iso'] . '" class="sp_link_lang">' . $lang['name'] . '</a>';
            }
        }
        ?>
    </div>
</div>