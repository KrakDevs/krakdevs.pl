<?php

namespace KrakDevs\WebBundle\Security\Core\User;

use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\User\UserInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider as BaseClass;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class FOSUBUserProvider extends BaseClass implements UserProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function connect(UserInterface $user, UserResponseInterface $response)
    {
        $accessor = new PropertyAccessor();
        $property = $this->getProperty($response);
        $username = $response->getUsername();
        $service = $response->getResourceOwner()->getName();

        if (null !== $previousUser = $this->userManager->findUserBy(array($property => $username))) {
            $accessor->setValue($previousUser, $property, null);
            $accessor->setValue($previousUser, $service . 'AccessToken', null);
            $this->userManager->updateUser($previousUser);
        }

        $accessor->setValue($user, $property, $username);
        $accessor->setValue($user, $service . 'AccessToken', $response->getAccessToken());

        $this->userManager->updateUser($user);
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $accessor = new PropertyAccessor();
        $service = $response->getResourceOwner()->getName();
        $username = $response->getUsername();
        $property = $this->getProperty($response);
        $user = $this->userManager->findUserBy(array($property => $username));

        if (!isset($user)) {
            $userWithEmail = $this->userManager->findUserByEmail($response->getEmail());
            if (isset($userWithEmail)) {
                throw new BadCredentialsException(sprintf("Email address \"%s\" already used.", $response->getEmail()));
            }

            $newUser = $this->userManager->createUser();
            $accessor->setValue($newUser, $property, $username);
            $accessor->setValue($newUser, $service . 'AccessToken', $response->getAccessToken());
            $newUser->setUsername($response->getNickname());
            $newUser->setEmail($response->getEmail());
            $newUser->setPassword($response->getAccessToken());
            $newUser->setEnabled(true);
            $this->userManager->updateUser($newUser);

            return $newUser;
        }

        $user = parent::loadUserByOAuthUserResponse($response);
        $accessor->setValue($user, $service . 'AccessToken', $response->getAccessToken());

        return $user;
    }

    public function supportsClass($class)
    {
        return $class === 'KrakDevs\WebBundle\Entity\User';
    }
}