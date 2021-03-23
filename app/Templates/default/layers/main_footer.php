<footer class="main_footer_wrap">
    <?php
    if ($this->getConfig('app','multilingual') == 'on') {
        foreach ($this->getConfig('langs','list') as $lang) {
            echo '<a href="' . $this->link($this->getPageData('clean_path'), $lang['iso']) . '" hreflang="' . $lang['iso'] . '" class="main_footer_link">' . $lang['name'] . '</a>';
        }
    }
    ?>
</footer>