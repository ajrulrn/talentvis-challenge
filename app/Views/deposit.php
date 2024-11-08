<?php $this->include('partials/_header') ?>
    <h2 class="text-center text-white">Deposit</h2>
    <div class="flex justify-center flex-column">
        <form action="/deposit/store" method="post">
            <div class="flex flex-column" style="flex-wrap: wrap;">
                <label for="amount" class="block">Amount</label>
                <input type="text" class="form-control" id="amount" name="amount" autofocus autocomplete="off">
                <small class="text-danger"><?= $this->getFlashData('deposit') ?></small>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <a href="/" class="back">Back</a>
<?php $this->include('partials/_footer') ?>
