<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

/**
 * Class LoadUserData
 *
 * @package AppBundle\DataFixtures\ORM
 */
class LoadUserData implements FixtureInterface
{
    /**
     * Load admin fixtures to test admin privilege
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setUsername('root');
        $userAdmin->setPlainPassword('root');
        $userAdmin->setEmail("root@admin.com");
        $userAdmin->setEnabled(true);
        $userAdmin->addRole("ROLE_ADMIN");

        $manager->persist($userAdmin);
        $manager->flush();
    }
}
