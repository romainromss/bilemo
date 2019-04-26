<?php
declare(strict_types=1);

/*
 * This file is part of the Bilemo project.
 *
 * (c) Romain Bayette <romainromss@posteo.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Actions\Phones;

use AppBundle\Actions\AbstractAction;
use AppBundle\Domains\Phones\ListPhones\LoaderPhoneList;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;

/**
 * Class ListPhonesAction.
 *
 * @author Romain Bayette <romainromss@posteo.net>
 */
class ListPhonesAction extends AbstractAction
{
    /** @var LoaderPhoneList */
    protected $loader;

    /**
     * ListPhonesAction constructor.
     *
     * @param LoaderPhoneList $loader
     */
    public function __construct(LoaderPhoneList $loader)
    {
        $this->loader = $loader;
    }

    /**
     * List of phones.
     *
     * @Route("/phones", name="list_phones", methods={"GET"})
     *
     * @SWG\Response(
     *     response="200",
     *     description="Returns the list of phones.",
     *     @SWG\Schema(ref=@Model(type=AppBundle\Entity\Phone::class, groups={"list_phones"}))
     * )
     *
     * @SWG\Response(
     *     response="404",
     *     description="No phone found, check your parameters."
     * )
     *
     * @SWG\Tag(name="Phones")
     * @Security(name="Bearer")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ListPhones()
    {
        $datas =  $this->loader->load();
        return $this->sendResponse($datas, 200, [], true);
    }
}
