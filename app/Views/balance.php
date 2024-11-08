<?php $this->include('partials/_header') ?>
    <h2 class="text-center text-white">Your Balance</h2>
    <p class="text-center text-white" style="font-size: 42pt;">
        <?= number_format($balance, 0, '', ',') ?>
    </p>
    <a href="/" class="back">Back</a>
<?php $this->include('partials/_footer') ?>
