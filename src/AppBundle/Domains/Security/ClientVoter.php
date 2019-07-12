<?php
/**
 * Created by PhpStorm.
 * User: romss
 * Date: 2019-04-08
 * Time: 21:02
 */

namespace AppBundle\Domains\Security;

use AppBundle\Entity\Client;
use AppBundle\Entity\Users;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class ClientVoter extends Voter
{

    const CLIENT_VOTER = 'CLIENT_VOTER';

    /**
     * Determines if the attribute and subject are supported by this voter.
     *
     * @param string $attribute An attribute
     * @param mixed $subject The subject to secure, e.g. an object the user wants to access or any other PHP type
     *
     * @return bool True if the attribute and subject are supported, false otherwise
     */
    protected function supports($attribute, $subject)
    {
        return $attribute == self::CLIENT_VOTER;
    }

    /**
     * Perform a single access check operation on a given attribute, subject and token.
     * It is safe to assume that $attribute and $subject already passed the "supports()" method check.
     *
     * @param string $attribute
     * @param mixed $subject
     * @param TokenInterface $token
     *
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $clientId = is_object($token->getUser()) ? $token->getUser()->getId()->toString() : null;
         return $subject === $clientId;
    }
}
