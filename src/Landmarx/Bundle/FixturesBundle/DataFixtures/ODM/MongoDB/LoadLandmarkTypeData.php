<?php
namespace Landmarx\Bundle\FixturesBundle\DataFixtures\ODM\MongoDB;

use Doctrine\Common\Persistence\ObjectManager;

class LoadLandmarkTypeData extends DataFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $populator = new \Faker\ORM\Doctrine\Populator($this->faker, $manager);
        $populator->addEntity('\Landmarx\Bundle\LandmarkBundle\Document\Type', $this->getFixtureMax('landmark_type'));
        
        $populator->execute();
        
        $manager->flush();
    }
    
    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 2;
    }
}
