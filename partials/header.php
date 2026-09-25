<header class="nav" data-nav>
    <div class="nav__bar">
        <a class="logo" href="#inicio" aria-label="Camecc — início">CAMEC<span class="lc">c</span></a>

        <nav class="nav__links" aria-label="Principal">
            <?php foreach ($data['nav'] as $item): ?>
                <a href="<?= e($item['href']) ?>" data-spy><?= e($item['label']) ?></a>
            <?php endforeach; ?>
        </nav>

        <a class="btn btn--red btn--sm nav__cta" href="#campeonatos">Campeonatos</a>

        <button class="burger" type="button" aria-label="Abrir menu" aria-expanded="false" aria-controls="menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</header>

<div class="menu" id="menu">
    <nav class="menu__links" aria-label="Menu móvel">
        <?php foreach ($data['nav'] as $i => $item): ?>
            <a href="<?= e($item['href']) ?>" style="--i:<?= $i ?>"><span><?= e($item['label']) ?></span></a>
        <?php endforeach; ?>
    </nav>
    <img class="menu__dog" src="<?= asset('assets/img/cameccao.webp') ?>" alt="" width="560" height="1011" loading="lazy">
</div>
