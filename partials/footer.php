<footer class="footer">
    <?= wave() ?>
    <div class="container footer__grid">
        <div class="footer__brand">
            <p class="footer__word" aria-hidden="true">CAMEC<span class="lc">c</span></p>
            <p class="footer__full"><?= e($site['full_name']) ?></p>
        </div>

        <nav class="footer__nav" aria-label="Rodapé">
            <?php foreach ($data['nav'] as $item): ?>
                <a href="<?= e($item['href']) ?>"><?= e($item['label']) ?></a>
            <?php endforeach; ?>
        </nav>
    </div>

    <div class="container footer__bottom">
        <p>© <?= date('Y') ?> Camecc. Todos os direitos reservados.</p>
        <a class="to-top" href="#inicio">Voltar ao topo <span aria-hidden="true">↑</span></a>
    </div>

    <img class="footer__dog" src="<?= asset('assets/img/cameccao-correndo.webp') ?>" alt="" width="900" height="720" loading="lazy">
</footer>
