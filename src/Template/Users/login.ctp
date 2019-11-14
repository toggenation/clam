
<!-- File: src/Template/Users/login.ctp -->
<?php
//$hasher = new \Cake\Auth\DefaultPasswordHasher();
//debug($hasher->hash('YOUR_PASSWORD_HERE'));

 ?>

<div class="col-lg-4 offset-lg-4">
    <div class="card bg-light">
        <div class="card-body">
<?= $this->Flash->render() ?>
<?= $this->Form->create() ?>
    <fieldset>

        <?= $this->Form->control('username') ?>
        <?= $this->Form->control('password') ?>
    </fieldset>
<?= $this->Form->button(__('Login')); ?>
<?= $this->Form->end() ?>
</div>
</div>
</div>
