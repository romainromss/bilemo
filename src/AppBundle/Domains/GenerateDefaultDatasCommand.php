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

namespace AppBundle\Domains;

use Doctrine\ORM\EntityManagerInterface;
use Nelmio\Alice\Loader\NativeLoader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GenerateDefaultDatasCommand.
 *
 * @author Romain Bayette <romainromss@posteo.net>
 */
class GenerateDefaultDatasCommand extends Command
{
    const PATH_TO_ENTRY_POINT = __DIR__ . '/../../../var/fixtures/dev/load.yml';
    /** @var EntityManagerInterface */
    protected $entityManager;
    public function __construct(
        EntityManagerInterface $entityManager,
        string $name = null
    ) {
        $this->entityManager = $entityManager;
        parent::__construct($name);
    }
    protected function configure()
    {
        $this
            ->setName('app:load-datas')
            ->setDescription('load default datas');
    }
    public function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $objectSet = $this->getLoader()->loadFile(self::PATH_TO_ENTRY_POINT);
        foreach ($objectSet->getObjects() as $object) {
            $this->entityManager->persist($object);
        }
        $this->entityManager->flush();
    }
    public function getLoader()
    {
        return new NativeLoader();
    }
}
