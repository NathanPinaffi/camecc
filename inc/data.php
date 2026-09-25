<?php
/**
 * Conteúdo editável do site do Camecc.
 * Edite aqui — o resto do site se monta sozinho.
 */

return [

    'site' => [
        'name'      => 'Camecc',
        'full_name' => 'Centro Acadêmico da Matemática, Estatística e Computação Científica',
        'tagline'   => 'A casa dos estudantes de Matemática, Estatística e Computação Científica.',
        'courses'   => ['Matemática', 'Estatística', 'Computação Científica'],
    ],

    'nav' => [
        ['href' => '#inicio',      'label' => 'Início'],
        ['href' => '#camecc',      'label' => 'O Camecc'],
        ['href' => '#membros',     'label' => 'Membros'],
        ['href' => '#campeonatos', 'label' => 'Campeonatos'],
        ['href' => '#contato',     'label' => 'Contato'],
    ],

    /*
     * Membros. Para adicionar a função de alguém, preencha 'role'
     * (ex.: 'role' => 'Presidência'). Enquanto estiver vazio, nada é exibido.
     * As fotos ficam em assets/img/membros/.
     */
    'members' => [
        ['name' => 'Betel',   'photo' => 'betel.webp',   'role' => ''],
        ['name' => 'Bruno',   'photo' => 'bruno.webp',   'role' => ''],
        ['name' => 'GBG',     'photo' => 'gbg.webp',     'role' => ''],
        ['name' => 'MG',      'photo' => 'mg.webp',      'role' => ''],
        ['name' => 'Rupolo',  'photo' => 'rupolo.webp',  'role' => ''],
        ['name' => 'Tavares', 'photo' => 'tavares.webp', 'role' => ''],
    ],

    /*
     * Campeonatos. 'stage' é o índice da etapa atual em 'stages'
     * (0 = primeira etapa). 'details' só aparece quando preenchido.
     */
    'stages' => ['Inscrições', 'Fase de grupos', 'Mata-mata', 'Final', 'Encerrado'],

    'tournaments' => [
        [
            'slug'    => 'trucamecc',
            'name'    => 'Trucamecc',
            'kicker'  => 'Truco',
            'icon'    => 'cards',
            'blurb'   => 'O campeonato de truco do Camecc. Blefe na cara de pau, grite TRUCO na hora certa e mostre quem manda no baralho.',
            'stage'   => 4,
            'details' => [
                'Datas'      => '',
                'Local'      => '',
            ],
        ],
        [
            'slug'    => 'snooker-open',
            'name'    => 'Snooker Open',
            'kicker'  => 'Sinuca',
            'icon'    => 'balls',
            'blurb'   => 'Taco na mão, giz no dedo e mesa verde pela frente. O torneio de sinuca do Camecc, aberto pra quem tem mira (ou muita sorte).',
            'stage'   => 1,
            'details' => [
                'Datas'      => '',
                'Local'      => '',
            ],
        ],
        [
            'slug'    => 'snooker-doubles',
            'name'    => 'Snooker Doubles',
            'kicker'  => 'Sinuca em duplas',
            'icon'    => 'doubles',
            'blurb'   => 'Duas cabeças, duas tacadas, uma mesa. Aqui a parceria decide o jogo — combine a estratégia e não deixe a dupla na mão.',
            'stage'   => 4,
            'details' => [
                'Datas'      => '',
                'Local'      => '',
            ],
        ],
    ],

    /*
     * Contatos. Preencha o que existir; o que ficar vazio não aparece.
     * Ex.: 'instagram' => 'https://instagram.com/seu_perfil'
     */
    'contact' => [
        'instagram' => '@cameccoficial',
        'whatsapp'  => '',
        'email'     => 'camecc@unicamp.br',
    ],
];
