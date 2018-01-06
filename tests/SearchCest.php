<?php
class LoginCest 
{    
    public function _before(AcceptanceTester $I)
    {
        $I->amOnUrl('https://market.yandex.ru');
    }

    public function searchTestShouldFail(AcceptanceTester $I)
    {
        $I->wantTo('find Nokia Lumia 520 White');
        $I->amOnPage('/');
        //asserting there is a search field and searching for 'nokia';
        $I->seeElement("//input[@id='header-search']");
        $I->fillField("//input[@id='header-search']", "nokia");
        $I->click("//button[@type='submit']");
        //waiting for the redirect to the brand page and moving on to a specific catalog;
        $I->performOn("//div[text()='Мобильные телефоны']", ['click' => "//div[text()='Мобильные телефоны']"], 5);
        //preloading all the results and searching for a specific phone;
        while (count($I->grabMultiple("//a[@class='button button_size_m button_theme_pseudo i-bem button_js_inited button_disabled_yes']")) == 0) {
            $I->scrollTo("//div[@class='pager-more__button pager-loader_preload']");
            $I->click("//div[@class='pager-more__button pager-loader_preload']");
            $I->wait(2);
        }
        $I->see('Nokia Lumia 520 White');
    }
}