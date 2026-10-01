<section id="membros" class="members section" style="--bg:var(--red)">
    <?= wave() ?>
    <div class="members__spots" aria-hidden="true">
        <?= blob('mspot mspot--a', 17, .3, '14s') ?>
        <?= blob('mspot mspot--b', 29, .3, '17s') ?>
        <?= blob('mspot mspot--c', 37, .3, '13s') ?>
    </div>

    <div class="container">
        <div class="section__head">
            <p class="eyebrow eyebrow--light" data-reveal="up">Gente do Camecc</p>
            <h2 class="display outline outline--light" aria-label="Quem faz o Camecc" data-reveal="letters">
                <?= letters('QUEM FAZ') ?><br><?= letters('O CAMECC', 8, true) ?>
            </h2>
            <p class="section__lead" data-reveal="up" style="--d:.25s">
                Conheça quem está por trás do centro acadêmico. É só chegar e trocar uma ideia.
            </p>
        </div>

        <ul class="members__grid">
            <?php foreach ($data['members'] as $i => $m): ?>
                <li class="member" data-reveal="up" style="--d:<?= ($i % 3) * .12 ?>s; --r:<?= [-1.6, 1.2, -.8, 1.4, -1.2, .9][$i % 6] ?>deg">
                    <article class="member__card" data-tilt>
                        <div class="member__photo">
                            <img src="<?= asset('assets/img/membros/' . $m['photo']) ?>" alt="Foto de <?= e($m['name']) ?>, membro do Camecc" width="300" height="300" loading="lazy">
                        </div>
                        <h3 class="member__name"><?= e($m['name']) ?></h3>
                        <?php if (!empty($m['role'])): ?>
                            <p class="member__role"><?= e($m['role']) ?></p>
                        <?php endif; ?>
                    </article>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
