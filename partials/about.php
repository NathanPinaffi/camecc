<?php
$stats = [
    ['n' => count($data['members']),     'label' => 'Membros'],
    ['n' => count($data['tournaments']), 'label' => 'Campeonatos'],
    ['n' => count($site['courses']),     'label' => 'Cursos'],
    ['n' => 1,                           'label' => 'Mascote'],
];
$pillars = [
    ['icon' => 'M12 2l2.4 6.9H22l-6 4.4 2.3 7L12 16l-6.3 4.3 2.3-7-6-4.4h7.6z', 'title' => 'Representação', 'text' => 'A voz dos estudantes nas conversas e decisões que fazem diferença na vida do curso.'],
    ['icon' => 'M8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm8 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM2 20c0-3.3 2.7-6 6-6s6 2.7 6 6zm12 0c0-1.9-.6-3.6-1.6-4.9.5-.1 1-.1 1.6-.1 3.3 0 6 2.7 6 6z', 'title' => 'Integração', 'text' => 'Calouros e veteranos no mesmo time. Aqui a galera se conhece, se ajuda e cresce junto.'],
    ['icon' => 'M7 2h10v2h3a1 1 0 0 1 1 1v2a5 5 0 0 1-4.3 4.9A6 6 0 0 1 13 15.9V18h3v3H8v-3h3v-2.1A6 6 0 0 1 7.3 11.9 5 5 0 0 1 3 7V5a1 1 0 0 1 1-1h3zM5 6v1a3 3 0 0 0 2 2.8V6zm14 0h-2v3.8A3 3 0 0 0 19 7z', 'title' => 'Eventos e campeonatos', 'text' => 'Truco, sinuca e muita resenha: a gente cria motivo pra sair da sala e viver a universidade.'],
];
?>
<section id="camecc" class="about section" style="--bg:var(--paper)">
    <?= formulas(19, 4) ?>
    <div class="container">
        <div class="about__head">
            <?= blob('about__blob', 121, .25, '20s') ?>
            <p class="eyebrow" data-reveal="up">Sobre nós</p>
            <h2 class="display outline about__title" aria-label="O que é o Camecc" data-reveal="letters">
                <?= letters('O QUE É O') ?><br><?= letters('CAMECC', 9, true) ?>
            </h2>
            <div class="about__lead" data-reveal="up" style="--d:.25s">
                <p class="lead">
                    O <strong>Camecc</strong> é o <?= e($site['full_name']) ?> — a casa dos estudantes dos nossos cursos, feita por estudantes.
                </p>
            </div>
            <div class="about__body" data-reveal="up" style="--d:.35s">
                <p>
                    Somos a ponte entre a turma e a universidade: representamos os alunos, organizamos eventos e criamos espaços para a galera se conhecer, se divertir e crescer junto, dentro e fora da sala de aula.
                </p>
                <ul class="pills" aria-label="Cursos representados">
                    <?php foreach ($site['courses'] as $c): ?>
                        <li><?= e($c) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <ul class="pillars">
            <?php foreach ($pillars as $i => $p): ?>
                <li class="pillar" data-reveal="up" data-tilt style="--d:<?= $i * .12 ?>s">
                    <span class="pillar__icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24"><path d="<?= $p['icon'] ?>"/></svg>
                    </span>
                    <h3><?= e($p['title']) ?></h3>
                    <p><?= e($p['text']) ?></p>
                </li>
            <?php endforeach; ?>
        </ul>

        <figure class="campus" data-run>
            <div class="campus__frame" data-reveal="clip">
                <?= blob('campus__blob', 61, .2, '20s') ?>
                <img src="<?= asset('assets/img/campus.webp') ?>" alt="Ilustração em preto e branco do prédio do campus, com árvores altas, mesas de concreto e um caminho até a entrada" width="1600" height="1191" loading="lazy">
            </div>
            <div class="campus__track" aria-hidden="true">
                <img class="campus__runner" src="<?= asset('assets/img/cameccao-correndo.webp') ?>" alt="" width="900" height="720" loading="lazy">
            </div>
            <figcaption>O nosso lugar. O Cameccão corre por aqui todo dia.</figcaption>
        </figure>
    </div>
</section>
