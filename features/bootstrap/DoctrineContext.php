<?php

use App\Domain\Models\User;
use AppBundle\Domains\Factory\ClientFactory;
use AppBundle\Entity\AbstractEntity;
use AppBundle\Entity\Client;
use AppBundle\Entity\Phone;
use AppBundle\Entity\Users;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\Tools\SchemaTool;
use Nelmio\Alice\Loader\NativeLoader;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

/**
 * Created by PhpStorm.
 * User: romss
 * Date: 2019-04-17
 * Time: 19:28
 */

class DoctrineContext implements Context
{
    private $schemaTool;

    /** @var RegistryInterface  */
    private $doctrine;

    /** @var KernelInterface  */
    private $kernel;

    /** @var EncoderFactoryInterface  */
    private $encoderFactory;

    /**
     * DoctrineContext constructor.
     * @param RegistryInterface $doctrine
     * @param KernelInterface $kernel
     * @param EncoderFactoryInterface $encoderFactory
     */
    public function __construct(
        RegistryInterface $doctrine,
        KernelInterface $kernel,
        EncoderFactoryInterface $encoderFactory
    )
    {
        $this->doctrine = $doctrine;
        $this->kernel = $kernel;
        $this->schemaTool = new SchemaTool($this->doctrine->getManager());
        $this->encoderFactory = $encoderFactory;
    }
    /**
     * @BeforeScenario
     * @throws \Doctrine\ORM\Tools\ToolsException
     */
    public function clearDatabase()
    {
        $this->schemaTool->dropSchema($this->doctrine->getManager()->getMetadataFactory()->getAllMetadata());
        $this->schemaTool->createSchema($this->doctrine->getManager()->getMetadataFactory()->getAllMetadata());
    }
    /**
     * @return ObjectManager
     */
    public function getManager()
    {
        return $this->doctrine->getManager();
    }
    /**
     * @param string $classEncoder
     * @return PasswordEncoderInterface
     */
    private function getEncoder(string $classEncoder)
    {
        return $this->encoderFactory->getEncoder($classEncoder);
    }
    /**
     * @Given I load the following client :
     * @param TableNode $table
     * @throws Exception
     */
    public function iLoadTheFollowingClient(TableNode $table)
    {
        foreach ($table->getHash() as $hash) {
            $user = new Client(
                $hash['username'],
                $this->getEncoder(Client::class)->encodePassword($hash['password'], ''),
                $hash['name'],
                $hash['lastname'],
                $hash['email'],
                $hash['b2b']
            );
            $this->getManager()->persist($user);
        }
        $this->getManager()->flush();
    }

    /**
     * @Given /^the client with username "([^"]*)" should exist in database$/
     *
     * @param $username
     * @throws NonUniqueResultException
     */
    public function theClientWithUsernameShouldExistInDatabase($username)
    {
        $client = $this->getManager()->getRepository(Client::class)
            ->createQueryBuilder('c')
            ->where('c.username = :client_username')
            ->setParameter('client_username', $username)
            ->getQuery()
            ->getOneOrNullResult()
        ;
        if (\is_null($client)) {
            throw new NotFoundHttpException(sprintf('Expected Client with username : %s', $username));
        }
    }

    /**
     * @Given /^I load fixtures with the following command "([^"]*)"$/
     *
     * @param $command
     *
     * @throws Exception
     */
    public function iLoadFixturesWithTheFollowingCommand($command)
    {
        $application = new Application($this->kernel);
        $application->setAutoExit(false);
        $input = new ArrayInput([
            'command' => $command,
            '--no-interaction' => true,
        ]);
        $output = new NullOutput();
        $application->run($input, $output);
    }

    /**
     * @Given /^I load fixture file "([^"]*)"$/
     *
     * @param $arg1
     *
     * @throws Exception
     */
    public function iLoadFixtureFile($arg1)
    {
        $loader = new NativeLoader();
        $objectSet = $loader->loadFile(__DIR__.'/../../var/fixtures/dev/'.$arg1);
        foreach($objectSet->getObjects() as $object) {
            if($object instanceof Phone) {
                $phone = new Phone(
                    $object->getName(),
                    $object->getDescription(),
                    [$object->getMemory()],
                    $object->getBrand(),
                    $object->getOs()
                );
                $this->getManager()->persist($phone);

            } else {
                $this->getManager()->persist($object);
            }
            $this->getManager()->flush();
        }
    }

    /**
     * @Given /^I load this phone :$/
     *
     * @param TableNode $table
     *
     * @throws Exception
     */
    public function iLoadThisPhone(TableNode $table)
    {
        foreach ($table->getHash() as $hash) {
            $phone = new Phone(
                $hash['name'],
                $hash['description'],
                $hash['memory'],
                $hash['brand'],
                $hash['os']
            );
            $this->doctrine->getManager()->persist($phone);
        }
        $this->doctrine->getManager()->flush();
    }

    /**
     * @Given phone with name "([^"]*)" should have following id :identifier
     *
     * @param $name
     * @param $identifier
     *
     * @throws NonUniqueResultException
     * @throws ReflectionException
     */
    public function phoneWithNameShouldHaveFollowingId($name, $identifier)
    {
        $phone = $this->getManager()->getRepository(Phone::class)
            ->createQueryBuilder('p')
            ->where('p.name = :phone_name')
            ->setParameter('phone_name', $name)
            ->getQuery()
            ->getOneOrNullResult()
        ;
        if (\is_null($phone)) {
            throw new NotFoundHttpException(sprintf('expected phone with name : %s', $name));
        }
        $this->resetUuid($phone, $identifier);
    }

    /**
     * @Given client with username :username should have following id :identifier
     * @param $username
     * @param $identifier
     *
     * @throws NonUniqueResultException
     * @throws ReflectionException
     */
    public function clientWithUsernameShouldHaveFollowingId($username, $identifier)
    {
        $client = $this->getManager()->getRepository(Client::class)
            ->createQueryBuilder('c')
            ->where('c.username = :client_username')
            ->setParameter('client_username', $username)
            ->getQuery()
            ->getOneOrNullResult()
        ;
        if (\is_null($client)) {
            throw new NotFoundHttpException(sprintf('Expected client with username : %s', $username));
        }
        $this->resetUuid($client, $identifier);
    }

    /**
     * @param AbstractEntity $entity
     * @param string $identifier
     * @throws ReflectionException
     */
    protected function resetUuid(AbstractEntity $entity, string $identifier)
    {
        $reflection = new \ReflectionClass($entity);
        $property = $reflection->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($entity, $identifier);
        $this->doctrine->getManager()->flush();
    }

    /**
     * @Given /^client have the following user:$/
     *
     * @param TableNode $table
     * @throws NonUniqueResultException
     */
    public function clientHaveTheFollowingUser(TableNode $table)
    {
        foreach ($table->getHash() as $hash) {
            $client = $this->doctrine->getManager()->getRepository(Client::class)
                ->createQueryBuilder('c')
                ->where('c.username = :client_username')
                ->setParameter('client_username', $hash['client'])
                ->getQuery()
                ->getOneOrNullResult()
            ;
            if (\is_null($client)) {
                throw new NotFoundHttpException(sprintf('Expected client with username : %s', $hash['client']));
            }
            $user = new Users(
                $hash['name'],
                $hash['lastname'],
                $hash['email'],
                (string) $hash['cellPhone'],
                $client
            );
            $this->doctrine->getManager()->persist($user);
        }
        $this->doctrine->getManager()->flush();
    }

    /**
     * @Given user with email :email should have following id :identifier
     *
     * @param $email
     * @param $identifier
     *
     * @throws NonUniqueResultException
     * @throws ReflectionException
     */
    public function userWithEmailShouldHaveFollowingId($email, $identifier)
    {
        $user = $this->getManager()->getRepository(Users::class)
            ->createQueryBuilder('u')
            ->where('u.email = :user_email')
            ->setParameter('user_email', $email)
            ->getQuery()
            ->getOneOrNullResult()
        ;
        if (\is_null($user)) {
            throw new NotFoundHttpException(sprintf('Expected user with email : %s', $email));
        }
        $this->resetUuid($user, $identifier);
    }
}
