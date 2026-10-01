<?php

function e(?string $s): string
{
    return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8');
}

/** URL de asset com cache-busting pela data de modificação. */
function asset(string $path): string
{
    $file = __DIR__ . '/../' . $path;
    $v = is_file($file) ? filemtime($file) : 0;
    return e($path) . '?v=' . $v;
}

/** Quebra um texto em letras animáveis. O elemento pai deve levar o aria-label com o texto real. */
function letters(string $text, int $offset = 0, bool $accentLast = false): string
{
    $out = '<span class="letters">';
    $i = $offset;
    $chars = preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY);
    $last = count($chars) - 1;
    foreach ($chars as $n => $ch) {
        if ($ch === ' ') {
            $out .= '<span class="letters__space" aria-hidden="true"> </span>';
            continue;
        }
        $cls = $accentLast && $n === $last ? 'letters__ch letters__ch--accent' : 'letters__ch';
        $out .= '<span class="' . $cls . '" aria-hidden="true" style="--i:' . $i++ . '">' . e($ch) . '</span>';
    }
    return $out . '</span>';
}

/** Caminho SVG de uma "mancha" orgânica (spline fechada de N pontos). */
function blob_d(int $seed, float $cx = 300, float $cy = 300, float $r = 220, float $var = .22, int $n = 8): string
{
    mt_srand($seed);
    $pts = [];
    for ($i = 0; $i < $n; $i++) {
        $a  = 2 * M_PI * $i / $n;
        $rr = $r * (1 + $var * (mt_rand(-1000, 1000) / 1000));
        $pts[] = [$cx + cos($a) * $rr, $cy + sin($a) * $rr];
    }
    $d = sprintf('M%.1F %.1F', $pts[0][0], $pts[0][1]);
    for ($i = 0; $i < $n; $i++) {
        $p0 = $pts[($i - 1 + $n) % $n];
        $p1 = $pts[$i];
        $p2 = $pts[($i + 1) % $n];
        $p3 = $pts[($i + 2) % $n];
        $d .= sprintf(
            ' C%.1F %.1F %.1F %.1F %.1F %.1F',
            $p1[0] + ($p2[0] - $p0[0]) / 6, $p1[1] + ($p2[1] - $p0[1]) / 6,
            $p2[0] - ($p3[0] - $p1[0]) / 6, $p2[1] - ($p3[1] - $p1[1]) / 6,
            $p2[0], $p2[1]
        );
    }
    return $d . 'Z';
}

/** SVG de mancha que muda de forma continuamente (SMIL, sem JS). */
function blob(string $class, int $seed, float $var = .24, string $dur = '16s'): string
{
    $values = implode(';', [blob_d($seed, var: $var), blob_d($seed + 7, var: $var), blob_d($seed + 13, var: $var), blob_d($seed, var: $var)]);
    return '<svg class="blob ' . e($class) . '" viewBox="0 0 600 600" aria-hidden="true" focusable="false">'
        . '<path d="' . blob_d($seed, var: $var) . '" fill="currentColor">'
        . '<animate attributeName="d" dur="' . e($dur) . '" repeatCount="indefinite" calcMode="spline" '
        . 'keyTimes="0;.33;.66;1" keySplines=".45 0 .55 1;.45 0 .55 1;.45 0 .55 1" values="' . $values . '"/>'
        . '</path></svg>';
}

/** Fórmulas "escritas a giz" espalhadas no fundo da seção (decorativas, deterministas pela seed). */
function formulas(int $seed, int $count = 4): string
{
    static $pool = [
        'E = mc²', '∫ f(x) dx', 'Σ n²', 'lim x→∞', 'π r²', '√(a² + b²)',
        'sen²θ + cos²θ = 1', 'd/dx', '∇ · F', 'P(A|B)', 'x = (-b ± √Δ) / 2a',
        'n!', 'O(n log n)', 'P(A ∩ B)', '∂f/∂x', 'Σ pᵢ = 1', 'μ ± σ', 'det(A)',
        '∀x ∈ ℝ', 'a² + b² = c²', 'f(x) = ax + b', 'χ²', 'λ = 1/μ', 'A ∪ B',
        'cos(θ)', '2ⁿ', 'if (n == 0)', 'while (true)', 'σ²', 'log₂(n)',
    ];

    mt_srand($seed);
    $idx = range(0, count($pool) - 1);
    for ($i = count($idx) - 1; $i > 0; $i--) {
        $j = mt_rand(0, $i);
        [$idx[$i], $idx[$j]] = [$idx[$j], $idx[$i]];
    }

    $out = '<div class="formulas" aria-hidden="true">';
    foreach (array_slice($idx, 0, $count) as $k) {
        $x = mt_rand(3, 84);
        $y = mt_rand(6, 86);
        $r = mt_rand(-9, 9);
        $fs = mt_rand(85, 155) / 100;
        $dur = mt_rand(78, 128) / 10;
        $delay = mt_rand(0, 42) / 10;
        $out .= '<span class="formula" style="--x:' . $x . '%; --y:' . $y . '%; --r:' . $r . 'deg; --fs:' . $fs . '; --dur:' . $dur . 's; --delay:' . $delay . 's">'
            . e($pool[$k]) . '</span>';
    }
    return $out . '</div>';
}

/** Divisória ondulada no topo da seção (preenche com a cor de fundo da própria seção). */
function wave(string $class = '', bool $flip = false): string
{
    $d = 'M0 40 C 120 0, 240 0, 360 30 S 600 80, 720 44 S 960 -6, 1080 30 S 1320 70, 1440 24 L1440 80 L0 80 Z';
    return '<svg class="wave ' . e($class) . ($flip ? ' wave--flip' : '') . '" viewBox="0 0 1440 80" preserveAspectRatio="none" aria-hidden="true" focusable="false"><path d="' . $d . '"/></svg>';
}
