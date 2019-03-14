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
     * @Route("/phones", name="list_phones", methods={"GET"})
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ListArticlesAction()
    {
        $datas =  $this->loader->load();
        return $this->sendResponse($datas);
    }
}
