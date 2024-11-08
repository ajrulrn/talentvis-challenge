<?php $this->include('partials/_header') ?>
    <h1 class="text-center text-white">Hi <?= $this->getSession('user')->name ?></h1>
    <ul style="list-style-type: none; padding: 0;">
        <li style="margin-bottom: 1rem;">
            <a href="/deposit" class="btn btn-light block" style="font-size: 18pt;">Deposit</a>
        </li>
        <li style="margin-bottom: 1rem;">
            <a href="/withdraw" class="btn btn-light block" style="font-size: 18pt;">Withdraw</a>
        </li>
        <li style="margin-bottom: 1rem;">
            <a href="/transfer" class="btn btn-light block" style="font-size: 18pt;">Transfer</a>
        </li>
        <li style="margin-bottom: 1rem;">
            <a href="/balance" class="btn btn-light block" style="font-size: 18pt;">Check Balance</a>
        </li>
        <li>
            <a href="/history" class="btn btn-light block" style="font-size: 18pt;">History</a>
        </li>
        <li>
            <a href="/logout" class="btn btn-danger block" style="font-size: 18pt;">Logout</a>
        </li>
    </ul>
<?php $this->include('partials/_footer') ?>
