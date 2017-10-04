<?php

class LoginCest
{
    // tests
    public function tryToLogin(FacebookTester $I)
    {
        $I->amOnPage('/');
        $I->fillField('input#email', '');
        $I->fillField('input#pass', '');
        $I->click('Log In');

        $this->friendsList($I);
    }

    private function reload($I)
    {
        $I->reloadPage();

        $this->friendsList($I);
    }

    private function friendsList($I)
    {
        // click friends icon notif on navbar
        $I->waitForElementVisible('//*[@id="fbRequestsJewel"]/a/div');
        $I->click('//*[@id="fbRequestsJewel"]/a/div');

        // wait for friend requests lists
        $I->waitForElementVisible('//div[@class="fbRequestList"]', 10);

        // visible friend requests
        $friendRequests = $I->grabMultiple('//li[@class="objectListItem"]//form//button[1]');

        // codecept_debug($friendRequests);

        foreach ($friendRequests as $friendRequest) {
            $I->click($friendRequest);
            $I->wait(5);
        }

        $this->reload($I);
    }
}
