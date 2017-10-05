<?php

class LoginCest
{
    private $addedCount = 0;
    private $addedLimit = 10;

    // tests
    public function tryToLogin(FacebookTester $I)
    {
        $I->amOnPage('/');
        $I->fillField('input#email', '09085721203');
        $I->fillField('input#pass', '41295367800mr**');
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

        foreach ($friendRequests as $friendRequest) {
            $I->click($friendRequest);
            $this->addedCount++;
            $I->wait(5);

            if ($this->addedCount >= $this->addedLimit) {
                break;
            }
        }

        $this->reload($I);
    }
}
