<!DOCTYPE html>
<html lang="<?= $this->getPageData('lang'); ?>">

<head>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="content-Type" content="<?= $this->getPageData('mime'); ?>; charset=<?= $this->getPageData('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $this->t($this->getPageData('name') . '_description'); ?>">
    <meta name="keywords" content="<?= $this->t($this->getPageData('name') . '_keywords'); ?>">
    <meta name="robots" content="<?= $this->getPageData('robot'); ?>">
    <meta name="twitter:title" content="<?= $this->t($this->getPageData('name') . '_title'); ?>">
    <meta name="twitter:description" content="<?= $this->t($this->getPageData('name') . '_description'); ?>">
    <meta name="twitter:image" content="<?= $this->getPageData('host'); ?>/images/<?= $this->getPageData('template'); ?>/images/default/icon/favicon-194x194.png">
    <meta name="twitter:site" content="<?= $this->getConfig('app')['site_name']; ?>">
    <meta property="og:title" content="<?= $this->t($this->getPageData('name') . '_title'); ?>">
    <meta property="og:description" content="<?= $this->t($this->getPageData('name') . '_description'); ?>">
    <meta property="og:image" content="<?= $this->getPageData('host') ?>/images/<?= $this->getPageData('template'); ?>/images/default/icon/favicon-194x194.png">
    <meta property="og:url" content="<?= $this->getPageData('url'); ?>">
    <meta property="og:locale" content="<?= $this->getPageData('lang'); ?>">
    <meta property="og:site_name" content="<?= $this->getConfig('app')['site_name']; ?>" />
    <link rel="alternate" hreflang="x-default" href="<?= $this->getConfig('langs')['default']; ?>">
    <?php
    if ($this->getConfig('app')['multilingual'] == 'on') {
        foreach ($this->getConfig('langs')['list'] as $lang) {
            echo '<link rel="alternate" hreflang="' . $lang['iso'] . '" href="' . $this->link($this->getPageData('clean_path'), $lang['iso']) . '">';
        }
    }
    if (!empty($this->d('preload'))) {
        foreach ($this->d('preload') as $elements) {
            if (!empty($elements)) {
                foreach ($elements as $elem) {
                    echo '<link rel="preload" href="' . ($elem['link'] ?? '') . '" as="' . ($elem['as'] ?? '') . '" type="' . ($elem['type'] ?? '') . '" ' . ($elem['addit'] ?? '') . '>' . PHP_EOL;
                }
            }
        }
    }
    if (!empty($this->d('styles'))) {
        foreach ($this->d('styles') as $style) {
            echo '<link rel="stylesheet" href="' . ($style['link'] ?? '') . '">';
        }
    }
    if (!empty($this->d('scripts'))) {
        foreach ($this->d('scripts') as $script) {
            echo '<script src="' . ($script['link'] ?? '') . '"></script>';
        }
    }
    if (!empty($_SERVER['QUERY_STRING'])) {
        echo '<link rel="canonical" href="' . $this->getPageData('url') . '">';
    }
    ?>
    <!-- start icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/images/default/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/default/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="194x194" href="/images/default/icon/favicon-194x194.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/images/default/icon/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/default/icon/favicon-16x16.png">
    <link rel="manifest" href="/images/default/icon/site.webmanifest">
    <link rel="mask-icon" href="/images/default/icon/safari-pinned-tab.svg" color="#4a4a4a">
    <link rel="shortcut icon" href="/images/default/icon/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="Zzila">
    <meta name="application-name" content="Zzila">
    <meta name="msapplication-TileColor" content="#000000">
    <meta name="msapplication-TileImage" content="/images/default/icon/mstile-144x144.png">
    <meta name="msapplication-config" content="/images/default/icon/browserconfig.xml">
    <meta name="theme-color" content="#424242">
    <!-- end icons -->
    <title><?= $this->t($this->getPageData('name') . '_title'); ?></title>
</head>

<body>

    <!--[if lt IE 9]>
        <script>
            document.createElement("article");
            document.createElement("aside");
            document.createElement("footer");
            document.createElement("header");
            document.createElement("nav");
            document.createElement("section");
        </script>
    <![endif]-->
    <?= $this->renderPage($this->getPageData('name')); ?>
</body>

</html>