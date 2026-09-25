# Camecc 2.0

Site do Camecc, Centro Acadêmico da Matemática, Estatística e Computação Científica.

## Estrutura

```
index.php        página principal (monta os partials)
inc/             dados editáveis (data.php) e funções auxiliares (helpers.php)
partials/        seções da página: hero, sobre, membros, campeonatos, contato...
assets/          CSS, JS e imagens usadas pelo site
originais/       imagens originais e referência de identidade (não vão para o deploy)
scripts/         build.php, que gera a versão estática
public/          versão estática gerada (é o que a Vercel publica)
vercel.json      configuração do deploy
```

## Editar o conteúdo

Membros, funções, campeonatos, status e contatos ficam em `inc/data.php`.

## Rodar localmente

```bash
php -S localhost:8080 -t .
```

## Publicar na Vercel

A Vercel não executa PHP, então ela publica a pasta `public/`. Depois de editar o site, gere de novo e faça o commit:

```bash
php scripts/build.php
```
