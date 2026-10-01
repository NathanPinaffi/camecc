<section id="inicio" class="hero" data-hero>
    <?= formulas(5, 4) ?>
    <div class="hero__bg" aria-hidden="true">
        <?= blob('hero__blob hero__blob--red', 11, .26, '18s') ?>
        <?= blob('hero__blob hero__blob--ink', 23, .3, '23s') ?>
        <?= blob('hero__blob hero__blob--ink2', 41, .32, '19s') ?>
        <?= blob('spot spot--a', 5, .3, '9s') ?>
        <?= blob('spot spot--b', 8, .3, '11s') ?>
        <?= blob('spot spot--c', 14, .3, '10s') ?>
        <?= blob('spot spot--d', 3, .3, '12s') ?>
    </div>

    <div class="container hero__grid">
        <div class="hero__copy">
            <p class="chip" data-reveal="up">Centro Acadêmico</p>

            <h1 class="hero__title outline" aria-label="Camecc" data-reveal="letters"><?= letters('CAMECC', 0, true) ?></h1>

            <p class="hero__sub" data-reveal="up" style="--d:.45s">
                Centro Acadêmico da <strong>Matemática</strong>, <strong>Estatística</strong> e <strong>Computação Científica</strong>.
            </p>

            <div class="hero__cta" data-reveal="up" style="--d:.6s">
                <a class="btn btn--ink" href="#camecc">Conheça o Camecc <span class="btn__arrow" aria-hidden="true">→</span></a>
                <a class="btn btn--ghost" href="#campeonatos">Ver campeonatos</a>
            </div>
        </div>

        <div class="hero__stage" data-reveal="pop" style="--d:.3s">
            <div class="hero__mascot-wrap" data-mouse="18">
                <img class="hero__mascot" src="<?= asset('assets/img/cameccao.webp') ?>" alt="Cameccão, o mascote dálmata do Camecc, com as mãos na cintura e um sorriso de canto" width="560" height="1011" fetchpriority="high">
                <p class="bubble" aria-hidden="true">Au au! Bem-vindo(a) ao Camecc!</p>
            </div>
            <span class="hero__shadow" aria-hidden="true"></span>
        </div>
    </div>

    <a class="scroll-cue" href="#camecc" aria-label="Rolar para a próxima seção">
        <span>Role</span>
        <i aria-hidden="true"></i>
    </a>
</section>

<div class="ticker" aria-hidden="true">
    <div class="ticker__band ticker__band--red">
        <div class="ticker__track">
            <?php for ($k = 0; $k < 2; $k++): ?>
                <ul>
                    <?php foreach (['Camecc', 'Matemática', 'Estatística', 'Centro Acadêmico', 'Computação Científica', 'Camecc', 'Matemática', 'Estatística', 'Centro Acadêmico', 'Computação Científica'] as $w): ?>
                        <li><span><?= $w === 'Camecc' ? 'Camec<span class="accent">c</span>' : e($w) ?></span></li>
                    <?php endforeach; ?>
                </ul>
            <?php endfor; ?>
        </div>
    </div>
    <div class="ticker__band ticker__band--ink">
        <div class="ticker__track ticker__track--rev">
            <?php for ($k = 0; $k < 2; $k++): ?>
                <ul>
                    <?php foreach (['Centro Acadêmico', 'Computação Científica', 'Camecc', 'Estatística', 'Matemática', 'Centro Acadêmico', 'Computação Científica', 'Camecc', 'Estatística', 'Matemática'] as $w): ?>
                        <li><span><?= $w === 'Camecc' ? 'Camec<span class="accent">c</span>' : e($w) ?></span></li>
                    <?php endforeach; ?>
                </ul>
            <?php endfor; ?>
        </div>
    </div>
</div>
