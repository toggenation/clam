<?php foreach ($css as $style) : ?>

    <?= $this->Html->css('/react/' . $style, [
            'block' => true
        ]); ?>
<?php endforeach; ?>

<script>
    window.__REACT_DEVTOOLS_GLOBAL_HOOK__.inject = function() {}
</script>

<div baseurl="<?= $this->Url->build('/', true); ?>" id="root"></div>

<?php foreach ($js as $script) : ?>

    <?= $this->Html->script('/react/' . $script); ?>

<?php endforeach; ?>
