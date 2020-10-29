<?php

return array(


    'pdf' => array(
        'enabled' => true,
        'binary'  => '/usr/local/bin/wkhtmltopdf',
        'timeout' => false,
        'options' => array(
            'dpi' => 96,
            'lowquality' => false,
            'enable-javascript' => true,
            'enable-external-links' => true,
            'enable-smart-shrinking' => true,
            'page-width' => 330,
            'page-height' => 215,
            'margin-bottom' => 16,
            'margin-left' => 15,
            'margin-right'=> 15,
            'margin-top' => 20,
            // 'minimum-font-size' => 10,
            'footer-center' => 'Halaman [page] / [toPage]',
            'footer-font-size' => 8,
            'footer-spacing' => 4,
            'footer-left' => '  Dicetak pada '.\Carbon\Carbon::now()->format('d-m-Y H:i:s')
        ),
        'env'     => array(),
    ),
    'image' => array(
        'enabled' => true,
        'binary'  => '/usr/local/bin/wkhtmltoimage',
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),


);
