<?php
use Cake\Core\Configure;
use Cake\Collection\Collection;
?>

<div class="container">


    <div class="row">
        <div class="col-lg-6 col-lg-offset-3 well well-lg">
            <h1>About</h1>
            <p>The Christian Life and Ministry Meeting Schedule Creator is an open source software web application</p>
            <ul>
                <li class="nav-item">Database: <strong><?= $dbconfig['database']; ?></strong></li>
                <li class="nav-item">Database Host: <strong><?= $dbconfig['host']; ?></strong></li>
            </ul>

            <h3>Open Source</h3>
            <p>The CL&M Creator uses the following tools</p>
            <ul>
                <li class="nav-item">PHP <?= PHP_VERSION ; ?></li>
                <li class="nav-item"><?= $this->Html->link("CakePHP " .  Configure::version(), 'http://cakephp.org/') ; ?></li>
                <li class="nav-item"><?= $this->Html->link('Bootstrap 4x', 'http://getbootstrap.com'); ?></li>
                <li class="nav-item"><?= $this->Html->link("Datepicker for Bootstrap v1.6.1", 'https://github.com/eternicode/bootstrap-datepicker'); ?>
                <li class="nav-item">jQuery</li>
                <li class="nav-item"><?= $this->Html->link("CakePHP 3 Bootstrap Helpers", 'https://github.com/Holt59/cakephp3-bootstrap-helpers'); ?></li>
                <li class="nav-item">PDF Output by <?= $this->Html->link("TCPDF", 'http://www.tcpdf.org/'); ?></li>
                  <li class="nav-item">MySQL database</li>
                  <li class="nav-item">Apache or Nginx Webserver</li>
            </ul>

        </div>
    </div>
    <div class="well">
    <h3>Colour Pallette</h3>
        <?php

    $colors = [

      ["desc" =>	"Main Heading BG", 	"color"	=> "392247", 	"width" =>	3],
 [ "desc" =>	"Meeting Heading Dark Stripe"	, "color" =>	"392247"	, "width" =>	3 ],
[ "desc" =>	"Meeting Heading Light Stripe"	, "color" =>	"56415d"	, "width" => 3 ],
[ "desc" =>	"Red Highlights & Lettering"	, "color" =>	"c18626"	, "width" =>	3 ],
[ "desc" =>	"Treasures Background & Headings"	, "color" =>	"606970"	, "width" =>	3 ],
[ "desc" =>	"Apply Background & Headings"	, "color" =>	"c18626"	, "width" =>	3 ],
[ "desc" =>	"Living Background & Headings"	, "color" =>	"961526"	, "width" =>	3 ],
[ "desc" =>	"Light Background 1"	, "color" =>	"ebece7"	, "width" =>	3 ],
[ "desc" =>	"Light Background 2"	, "color" =>	"faf8f2"	, "width" =>	3 ],
[ "desc" =>	"Light Background 3"	, "color" =>	"f6f4ef"	, "width" =>	3 ],
[ "desc" =>	"Light Background 4"	, "color" =>	"efefef"	, "width" =>	3 ],
[ "desc" =>	"Light Background 5"	, "color" =>	"e6e7e2"	, "width" =>	3 ],
[ "desc" =>	"Near Black Background"	, "color" =>	"02050a"	, "width" =>	12 ]

        ]   ;

            $col = new Collection($colors);
            $chunked = $col->chunk(4);
            foreach ($chunked as $chunk): ?>
    <div class="row">
        <?php
            foreach($chunk as $ch): ?>
                <div class="col-lg-<?= $ch['width']; ?>">
                    <h4><?= $ch['desc']; ?></h4>
                    <p>HTML Code <strong>#<?= $ch['color']; ?></strong></p>
                    <div class="col-lg-12" style="background-color: #<?= $ch['color']; ?>; height: 60px;">

                    </div>
                </div>
        <?php
         endforeach;
         ; ?>

        </div>
        <?php endforeach; ?>
    </div>
    </div>
