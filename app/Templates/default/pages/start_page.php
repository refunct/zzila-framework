<div class="sp_wrap">
    <div class="sp_logo">ZZILA</div>
    <div class="sp_info"><?= $this->t('sp_framework') ?></div>
    <div class="sp_links">
        <a href="https://zzila.com" target="_blank" class="sp_link"><?= $this->t('sp_ofsite') ?></a>
        <a href="https://zzila.com/docs" target="_blank" class="sp_link"><?= $this->t('sp_doc') ?></a>
        <a href="https://github.com/refunct/zzila-framework/blob/main/README.md" target="_blank" class="sp_link">README.md</a>
    </div>
    <div class="sp_wrap_git">
        <div id="sp_copy_status"><?= $this->t('sp_copy') ?></div>
        <div class="sp_git">
            <span id="sp_gittext">git clone https://github.com/refunct/zzila-framework.git</span>
            <a href="" onclick="return copySelected(event, 'sp_gittext');" class="sp_copy"></a>
        </div>
    </div>
    <a href="https://www.donationalerts.com/r/refunct" target="_blank" class="sp_support"><?= $this->t('sp_support') ?></a>
    <div class="sp_langs">
        <?php
        if ($this->getConfig('app')['multilingual'] == 'on') {
            foreach ($this->getConfig('langs')['list'] as $lang) {
                echo '<a href="' . $this->link($this->getPageData('clean_path'), $lang['iso']) . '" hreflang="' . $lang['iso'] . '" class="sp_link_lang">' . $lang['name'] . '</a>';
            }
        }
        ?>
    </div>
</div>