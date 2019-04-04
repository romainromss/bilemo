<?php
/**
 * Created by PhpStorm.
 * User: romss
 * Date: 2019-03-21
 * Time: 19:43
 */

namespace AppBundle\Actions\Users;


use AppBundle\Actions\AbstractAction;
use AppBundle\Domains\Users\DeleteUser\LoaderDeleteUser;
use AppBundle\Domains\Users\DeleteUser\RequestResolverDeleteUser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DeleteUserAction extends AbstractAction
{
    /**
     * @var LoaderDeleteUser
     */
    private $loader;

    /**
     * @var RequestResolverDeleteUser
     */
    private $requestResolverDeleteUser;

    public function __construct(
        LoaderDeleteUser $loader,
        RequestResolverDeleteUser $requestResolverDeleteUser
    ) {
        $this->loader = $loader;
        $this->requestResolverDeleteUser = $requestResolverDeleteUser;
    }

    /**
     * @Route("/clients/{client_id}/users/{id_user}", name="delete_user", methods={"DELETE"})
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \ReflectionException
     */
    public function addUser(Request $request)
    {
        $input = $this->requestResolverDeleteUser->resolver($request);

        $data = $this->loader->load($input);
        return $this->sendResponse(null, 204, $data);
    }
}