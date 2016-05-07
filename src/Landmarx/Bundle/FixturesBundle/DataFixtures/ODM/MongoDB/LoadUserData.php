<?php
namespace Landmarx\Bundle\FixturesBundle\DataFixtures\ODM\MongoDB;

use \Doctrine\Common\Persistence\ObjectManager;

class LoadUserData extends DataFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $populator = new \Faker\ORM\Doctrine\Populator($this->faker, $manager);
        // Admin
        $populator->addEntity(
            '\Landmarx\Bundle\UserBundle\Document\User',
            1,
            array(
                'roles' => array('ROLE_ADMIN')
            )
        );
        // Users
        $populator->addEntity(
            '\Landmarx\Bundle\UserBundle\Document\User',
            5,
            array(
                'roles' => array('ROLE_USER')
            )
        );

        $populator->execute();

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 1;
    }
}
