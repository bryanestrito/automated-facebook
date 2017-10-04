<?php


class LoginCest
{
    // public function _before(FacebookTester $I)
    // {
    // }

    // public function _after(FacebookTester $I)
    // {
    // }

    // tests
    public function tryToLogin(FacebookTester $I)
    {
        $I->amOnPage('/');
        $I->fillField('input#email', '');
        $I->fillField('input#pass', '');
        $I->wait(2);
        $I->click('form#login_form input[type=submit]');
        $I->pauseExecution();

    }
}
