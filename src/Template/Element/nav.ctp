
<?php


echo $this->Nav->create([
    'name' => 'CL&M',
    'url' => '/',
    'options' => [
        'title' => 'Christian Life & Ministry Creator',
    ],
], [
    'container' => true,
    'fixed' => 'top',
    'theme' => 'dark'
]);
?>
<?php if ($loggedIn): ?>
<?=$this->Nav->beginMenu('Top');?>
<?=$this->Nav->beginMenu($this->Icon->faIcon('fas fa-cog') . ' Configure');?>
<?=$this->Nav->header('People & Privileges');?>
<?=$this->Nav->link("People", ['controller' => 'people', 'action' => 'index']);?>
<?=$this->Nav->link("Privileges", ['controller' => 'privileges', 'action' => 'index']);?>
<?=$this->Nav->divider();?>
<?=$this->Nav->header('Meeting Parts');?>
<?=$this->Nav->link("Sections", ['controller' => 'sections', 'action' => 'index']);?>
<?=$this->Nav->link("Parts", ['controller' => 'parts', 'action' => 'index']);?>
<?=$this->Nav->divider();?>
<?=$this->Nav->header('App Settings');?>
<?=$this->Nav->link("Settings", ['controller' => 'Settings', 'action' => 'configure']);?>
<?=$this->Nav->endMenu();?>
<?= $this->Nav->link($this->Icon->faIcon('far fa-file-alt') . " Schedules", ['controller' => 'assigned', 'action' => 'scheduleEdit']);?>
<?= $this->Nav->link($this->Icon->faIcon('far fa-file-alt') . " View all", ['controller' => 'schedules', 'action' => 'schedulePrint']);?>
<?=$this->Nav->endMenu();?>

<?=$this->Nav->beginMenu(['class' => 'navbar-right ml-auto']);?>
<?=$this->Nav->link($this->Icon->faIcon('fas fa-sign-out-alt') . " Logout <small>[" . $userInfo->full_name  . ']</small>', ['controller' => 'Users', 'action' => 'logout']);?>
<?=$this->Nav->link($this->Icon->faIcon('fas fa-info-circle') . " About", ['controller' => 'Pages', 'action' => 'display', 'about']);?>
<?=$this->Nav->endMenu();?>
<?php else: ?>
<?=$this->Nav->beginMenu(['class' => 'navbar-right ml-auto']);?>
<?=$this->Nav->link($this->Icon->faIcon('fas fa-sign-in-alt') . " Login", ['controller' => 'Users', 'action' => 'login']);?>
<?=$this->Nav->endMenu();?>
<?php endif;?>
<?=$this->Nav->end();?>
