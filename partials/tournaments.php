<?php
$stages = $data['stages'];
$stageNames = array_unique(array_map(fn ($t) => $stages[$t['stage']] ?? '', $data['tournaments']));
$allSame = count($stageNames) === 1;
$currentName = $allSame ? reset($stageNames) : null;

if (!function_exists('tournament_icon')) {
    function tournament_icon(string $name): string
    {
        $heart = 'M0 16 C-32 -4 -24 -28 -9 -24 C-3 -22 0 -15 0 -15 C0 -15 3 -22 9 -24 C24 -28 32 -4 0 16Z';
        $ball = fn (float $x, float $y, string $fill) =>
            '<g class="ball"><circle cx="' . $x . '" cy="' . $y . '" r="12.5" fill="' . $fill . '" stroke="#0e0e0e" stroke-width="4"/>'
            . '<ellipse cx="' . ($x - 4) . '" cy="' . ($y - 5) . '" rx="3.6" ry="2.2" fill="#fff" opacity=".85" transform="rotate(-30 ' . ($x - 4) . ' ' . ($y - 5) . ')"/></g>';

        // 3 pips centrados em uma coluna (símbolo desenhado ao redor de 0,0)
        $pips = fn (string $symbol) => implode('', array_map(
            fn (int $y) => '<g transform="translate(0 ' . $y . ') scale(.36)">' . $symbol . '</g>',
            [-30, 0, 30]
        ));
        $club = '<circle cx="0" cy="-15" r="13" fill="#0e0e0e"/><circle cx="-15" cy="9" r="13" fill="#0e0e0e"/><circle cx="15" cy="9" r="13" fill="#0e0e0e"/><path d="M-5 32 L5 32 L0 4Z" fill="#0e0e0e"/>';
        $heartPip = '<path d="' . $heart . '" fill="#e11d1d" stroke="#0e0e0e" stroke-width="3" transform="translate(0 6)"/>';
        $font = 'font-family="Titan One, Arial Black, sans-serif" font-size="17"';
        $rows = [
            [[0, '#f6d33b']],
            [[-13, '#2e9e4f'], [13, '#8a5a2b']],
            [[-26, '#2f6fd6'], [0, '#f28bb5'], [26, '#0e0e0e']],
            [[-39, '#e11d1d'], [-13, '#f28a1e'], [13, '#7b4fc4'], [39, '#21b5b0']],
        ];

        switch ($name) {
            case 'cards':
                return '<svg class="ticon ticon--cards" viewBox="0 0 200 160" aria-hidden="true" focusable="false">'
                    . '<g transform="translate(66 82)"><g class="card card--l"><rect x="-38" y="-56" width="76" height="112" rx="10" fill="#fbf8f3" stroke="#0e0e0e" stroke-width="4"/>'
                    . '<text x="-29" y="-36" ' . $font . ' fill="#e11d1d">3</text>' . $pips($heartPip) . '</g></g>'
                    . '<g transform="translate(136 82)"><g class="card card--r"><rect x="-38" y="-56" width="76" height="112" rx="10" fill="#fbf8f3" stroke="#0e0e0e" stroke-width="4"/>'
                    . '<text x="-29" y="-36" ' . $font . ' fill="#0e0e0e">3</text>' . $pips($club) . '</g></g>'
                    . '</svg>';
            case 'balls':
                $out = '<svg class="ticon ticon--balls" viewBox="0 0 200 160" aria-hidden="true" focusable="false"><g transform="translate(100 80) scale(1.25) translate(-100 -80)">';
                foreach ($rows as $c => $row) {
                    foreach ($row as [$dy, $color]) {
                        $out .= $ball(61 + $c * 26, 80 + $dy, $color);
                    }
                }
                return $out . '</g></svg>';
            default:
                return '<svg class="ticon ticon--doubles" viewBox="0 0 200 160" aria-hidden="true" focusable="false">'
                    . '<g class="cue cue--a"><line x1="28" y1="16" x2="172" y2="144" stroke="#0e0e0e" stroke-width="12" stroke-linecap="round"/><line x1="28" y1="16" x2="120" y2="98" stroke="#fbf8f3" stroke-width="5" stroke-linecap="round"/></g>'
                    . '<g class="cue cue--b"><line x1="172" y1="16" x2="28" y2="144" stroke="#0e0e0e" stroke-width="12" stroke-linecap="round"/><line x1="172" y1="16" x2="80" y2="98" stroke="#f6b93b" stroke-width="5" stroke-linecap="round"/></g>'
                    . $ball(84, 80, '#e11d1d') . $ball(118, 80, '#2f6fd6')
                    . '</svg>';
        }
    }
}
?>
<section id="campeonatos" class="tournaments section" style="--bg:var(--ink)">
    <?= wave() ?>
    <?= formulas(47, 4) ?>
    <div class="tournaments__bg" aria-hidden="true">
        <?= blob('tblob tblob--a', 71, .26, '21s') ?>
        <?= blob('tblob tblob--b', 83, .28, '25s') ?>
    </div>

    <div class="container">
        <div class="section__head">
            <p class="eyebrow eyebrow--red" data-reveal="up">Bora competir</p>
            <h2 class="display outline outline--red" aria-label="Campeonatos do Camecc" data-reveal="letters">
                <?= letters('CAMPEONATOS') ?>
            </h2>
            <p class="section__lead" data-reveal="up" style="--d:.25s">
                <?php if ($currentName): ?>
                    Todos os campeonatos estão na <strong><?= e($currentName) ?></strong>. Prepare o baralho, o taco e a torcida.
                <?php else: ?>
                    Prepare o baralho, o taco e a torcida: os campeonatos do Camecc estão rolando.
                <?php endif; ?>
            </p>
        </div>

        <div class="tournaments__grid">
            <?php foreach ($data['tournaments'] as $i => $t):
                $cur = (int) $t['stage'];
                $n = count($stages);
                $details = array_filter($t['details'] ?? [], fn ($v) => $v !== '');
                ?>
                <article class="tcard tcard--<?= e($t['icon']) ?>" id="<?= e($t['slug']) ?>" data-reveal="up" data-tilt style="--d:<?= $i * .14 ?>s; --cur:<?= $cur ?>; --n:<?= $n ?>">
                    <div class="tcard__art">
                        <?= blob('tcard__blob', 90 + $i * 9, .22, (14 + $i * 3) . 's') ?>
                        <?= tournament_icon($t['icon']) ?>
                    </div>

                    <p class="tcard__kicker"><?= e($t['kicker']) ?></p>
                    <h3 class="tcard__title"><?= e($t['name']) ?></h3>

                    <p class="status"><span class="status__dot" aria-hidden="true"></span><?= e($stages[$cur] ?? '') ?><span class="visually-hidden"> — etapa atual</span></p>

                    <p class="tcard__blurb"><?= e($t['blurb']) ?></p>

                    <ol class="stepper" aria-label="Etapas do campeonato">
                        <?php foreach ($stages as $s => $label):
                            $state = $s < $cur ? 'done' : ($s === $cur ? 'current' : 'todo');
                            ?>
                            <li class="stepper__item stepper__item--<?= $state ?>"<?= $state === 'current' ? ' aria-current="step"' : '' ?>>
                                <span class="stepper__dot" aria-hidden="true"><?= $state === 'done' ? '✓' : $s + 1 ?></span>
                                <span class="stepper__label"><?= e($label) ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ol>

                    <?php if ($details): ?>
                        <dl class="tcard__details">
                            <?php foreach ($details as $k => $v): ?>
                                <div><dt><?= e((string) $k) ?></dt><dd><?= e($v) ?></dd></div>
                            <?php endforeach; ?>
                        </dl>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
