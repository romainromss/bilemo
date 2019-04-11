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
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;

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
     * Delete a User for a Client.
     *
     * @Route("/clients/{client_id}/users/{user_id}", name="delete_user", methods={"DELETE"})
     *
     * @SWG\Response(
     *     response="204",
     *     description="User deleted."
     * )
     *
     * @SWG\Response(
     *     response="404",
     *     description="No user found, check your parameters."
     * )
     *
     * @SWG\Parameter(
     *     name="client",
     *     in="path",
     *     type="string",
     *     description="Id client."
     * )
     *
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="string",
     *     description="Id user."
     * )
     *
     * @SWG\Tag(name="User")
     * @Security(name="Bearer")
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