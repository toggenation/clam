<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$title_description = "Christian Life and Ministry Creator";
?>
<!DOCTYPE html>
<html class="no-js" lang="en_AU">
    <head>
        <?= $this->Html->charset() ?>
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            <?= $title_description ?>:
            <?= $this->fetch('title') ?>
        </title>

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link href="https://fonts.googleapis.com/css?family=Arimo|Raleway" rel="stylesheet">
        <?php
        $this->Html->script([
			'vendor/modernizr-2.8.3.min',
           'vendor/jquery-3.3.1.min',
           //'vendor/jquery.min',
            'plugins',
            'bootstrap.min'
                ], ['block' => 'end_script']);
        ?>

        <?=
        $this->Html->meta(
                'clm.png', '/img/clm.png', ['type' => 'icon']
        );
        ?>


        <?php
        $this->Html->css([

            'bootstrap.min',
			'fontawesome-all.min',
			'clam'

        ]	, ['block' => true])
        ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('cssFromView'); ?>
				<?= $this->fetch('meta') ?>


        <?= $this->fetch('script') ?>
    </head>
    <body style="padding-top: 70px;">
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <?= $this->element('nav'); ?>

        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
        <footer>
        </footer>
        <?= $this->fetch('end_script'); ?>
        <?= $this->fetch('from_view'); ?>
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
       <!-- <script>
            (function (b, o, i, l, e, r) {
                b.GoogleAnalyticsObject = l;
                b[l] || (b[l] =
                        function () {
                            (b[l].q = b[l].q || []).push(arguments)
                        });
                b[l].l = +new Date;
                e = o.createElement(i);
                r = o.getElementsByTagName(i)[0];
                e.src = 'https://www.google-analytics.com/analytics.js';
                r.parentNode.insertBefore(e, r)
            }(window, document, 'script', 'ga'));
            ga('create', 'UA-XXXXX-X', 'auto');
            ga('send', 'pageview');
        </script> -->
    </body>
</html>
