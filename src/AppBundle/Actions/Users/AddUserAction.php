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
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;

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
     * Add a User for a Client.
     *
     * @Route("/clients/{client_id}/users", name="add_user", methods={"POST"})
     *
     * @SWG\Response(
     *     response="201",
     *     description=" A new user created.",
     *     @SWG\Schema(ref=@Model(type="Users::class", groups={"add_user"}))
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
     *     name="user",
     *     in="body",
     *     required=true,
     *     @SWG\Schema(
     *          ref=@Model(type="Users::class", groups={"add_user"})
     *     )
     * )
     *
     * @SWG\Tag(name="User")
     * @Security(name="Bearer")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addUser(Request $request)
    {
        $input = $this->requestResolverAddUser->resolver($request);

        $data = $this->loader->load($input);
        return $this->sendResponse(null, 201, $data);
    }
}
