<?php

use Behat\Gherkin\Node\PyStringNode;
use Behatch\Context\RestContext;

/**
 * Created by PhpStorm.
 * User: romss
 * Date: 2019-04-17
 * Time: 19:54
 */

class CustomRestContext extends RestContext
{

    /**
     * @When /^I send a "([^"]*)" request to "([^"]*)" with username "([^"]*)" and password "([^"]*)"$/
     */
    public function iSendARequestToWithUsernameAndPassword($arg1, $arg2, $username, $password)
    {
        $requestLogin = $this->request->send(
            $arg1,
            $this->locatePath($arg2),
            [],
            [],
            json_encode([
                "username" => $username,
                "password" => (string) $password
            ]),
            ['CONTENT_TYPE' => 'application/json']
        );
        return $requestLogin->getContent();
    }

    /**
     * @When /^After authentication on url "([^"]*)" with method "([^"]*)" as username "([^"]*)" and password "([^"]*)", I send a "([^"]*)" request to "([^"]*)" with body:$/
     * @param $urlLogin
     * @param $methodLogin
     * @param $username
     * @param $password
     * @param $method
     * @param $url
     * @param PyStringNode $string
     *
     * @return
     */
    public function afterAuthenticationOnUrlWithMethodAsUsernameAndPasswordISendARequestToWithBody($urlLogin, $methodLogin, $username, $password, $method, $url, PyStringNode $string)
    {
        $requestLogin = $this->request->send(
            $methodLogin,
            $this->locatePath($urlLogin),
            [],
            [],
            json_encode([
                "username" => $username,
                "password" => $password
            ]),
            ['CONTENT_TYPE' => 'application/json']
        );
        $responseLogin = json_decode($requestLogin->getContent(), true);
        $request = $this->request->send(
            $method,
            $this->locatePath($url),
            [],
            [],
            $string !== null ? $string->getRaw() : null,
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_Authorization' => sprintf('Bearer %s', $responseLogin['token'])
            ]
        );
        return $request->getContent();
    }
}
