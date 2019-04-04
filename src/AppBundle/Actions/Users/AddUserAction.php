<?php
/**
 * Created by PhpStorm.
 * User: romss
 * Date: 2019-03-21
 * Time: 18:18
 */

namespace AppBundle\Actions\Users;

use AppBundle\Actions\AbstractAction;
use AppBundle\Domains\Users\AddUser\LoaderAddUser;
use AppBundle\Domains\Users\AddUser\RequestResolverAddUser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AddUserAction extends AbstractAction
{
    /**
     * @var LoaderAddUser
     */
    private $loader;

    /**
     * @var RequestResolverAddUser
     */
    private $requestResolverAddUser;

    public function __construct(
      LoaderAddUser $loader,
      RequestResolverAddUser $requestResolverAddUser
    ) {
        $this->loader = $loader;
        $this->requestResolverAddUser = $requestResolverAddUser;
    }

    /**
     * @Route("/clients/{client_id}/users", name="add_user", methods={"POST"})
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \ReflectionException
     */
    public function addUser(Request $request)
    {
        $input = $this->requestResolverAddUser->resolver($request);

        $data = $this->loader->load($input);
        return $this->sendResponse(null, 201, $data);
    }
}
