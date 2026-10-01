<?php
$c = $data['contact'];
$links = [];
if (!empty($c['instagram'])) $links[] = ['href' => $c['instagram'], 'label' => 'Instagram', 'cls' => 'btn--ink', 'ext' => true];
if (!empty($c['whatsapp']))  $links[] = ['href' => $c['whatsapp'],  'label' => 'WhatsApp',  'cls' => 'btn--red', 'ext' => true];
if (!empty($c['email']))     $links[] = ['href' => 'mailto:' . $c['email'], 'label' => $c['email'], 'cls' => 'btn--ghost', 'ext' => false];
?>
<section id="contato" class="contact section" style="--bg:var(--paper)">
    <?= wave() ?>
    <div class="container">
        <div class="contact__panel" data-reveal="clip">
            <?= blob('contact__blob contact__blob--a', 101, .24, '19s') ?>
            <?= blob('contact__blob contact__blob--b', 113, .3, '23s') ?>

            <div class="contact__copy">
                <p class="eyebrow eyebrow--light">Fale com a gente</p>
                <h2 class="display outline outline--light" aria-label="Bora fazer parte?">
                    <?= letters('BORA FAZER') ?><br><?= letters('PARTE?', 10) ?>
                </h2>
                <p class="contact__text">
                    Dúvidas, ideias, vontade de entrar no time ou só de acompanhar os campeonatos? O Camecc é de todo mundo da Matemática, Estatística e Computação Científica.
                </p>

                <?php if ($links): ?>
                    <div class="contact__links">
                        <?php foreach ($links as $l): ?>
                            <a class="btn <?= e($l['cls']) ?>" href="<?= e($l['href']) ?>"<?= $l['ext'] ? ' target="_blank" rel="noopener noreferrer"' : '' ?>><?= e($l['label']) ?></a>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="contact__soon">Nossos canais de contato chegam em breve. Enquanto isso, é só chamar qualquer membro do Camecc pelos corredores.</p>
                <?php endif; ?>
            </div>

            <img class="contact__dog" src="<?= asset('assets/img/cameccao.webp') ?>" alt="" width="560" height="1011" loading="lazy">
        </div>
    </div>
</section>
