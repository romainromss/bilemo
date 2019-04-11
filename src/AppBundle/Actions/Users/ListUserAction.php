<?php
/**
 * Created by PhpStorm.
 * User: romss
 * Date: 2019-03-21
 * Time: 19:44
 */

namespace AppBundle\Actions\Users;

use AppBundle\Actions\AbstractAction;
use AppBundle\Domains\Users\ListUsers\LoaderListUsers;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;

class ListUserAction extends AbstractAction
{
    /** @var LoaderListUsers */
    protected $loader;

    /**
     * ListPhonesAction constructor.
     *
     * @param LoaderListUsers $loader
     */
    public function __construct(LoaderListUsers $loader)
    {
        $this->loader = $loader;
    }

    /**
     * List of Users for Client.
     *
     * @Route("/clients/{client_id}/users", name="list_users", methods={"GET"})
     *
     *@SWG\Response(
     *     response="200",
     *     description="List of users.",
     *      @SWG\Schema(ref=@Model(type="Users::class", groups={"list_users"}))
     * )
     * @SWG\Response(
     *     response="404",
     *     description="No user found please check parameters."
     * )
     *
     *
     * @SWG\Parameter(
     *     name="client",
     *     in="path",
     *     type="string",
     *     description="Id client."
     * )
     *
     * @SWG\Tag(name="User")
     * @Security(name="Bearer")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function ListUsers(Request $request)
    {
        $datas =  $this->loader->load($request);
        return $this->sendResponse($datas);
    }
}
