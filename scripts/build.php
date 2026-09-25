<?php
declare(strict_types=1);

/**
 * Gera a versão estática do site em public/ (index.html + assets),
 * para hospedar em serviços sem PHP, como a Vercel.
 * Uso: php scripts/build.php   (rode de novo sempre que editar o site)
 */

$root = dirname(__DIR__);
$out = $root . '/public';

function rrmdir(string $dir): void
{
    if (!is_dir($dir)) return;
    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST) as $f) {
        $f->isDir() ? rmdir($f->getPathname()) : unlink($f->getPathname());
    }
    rmdir($dir);
}

function rcopy(string $from, string $to): void
{
    @mkdir($to, 0777, true);
    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($from, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::SELF_FIRST) as $f) {
        $dest = $to . '/' . substr($f->getPathname(), strlen($from) + 1);
        $f->isDir() ? @mkdir($dest, 0777, true) : copy($f->getPathname(), $dest);
    }
}

rrmdir($out);
mkdir($out, 0777, true);

ob_start();
require $root . '/index.php';
file_put_contents($out . '/index.html', ob_get_clean());

rcopy($root . '/assets', $out . '/assets');

echo "Site estático gerado em public/\n";
