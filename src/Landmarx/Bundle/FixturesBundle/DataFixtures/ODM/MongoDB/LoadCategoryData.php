<?php
namespace Landmarx\Bundle\FixturesBundle\DataFixtures\ODM\MongoDB;

use Doctrine\Common\Persistence\ObjectManager;

class LoadCategoryData extends DataFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $populator = new \Faker\ORM\Doctrine\Populator($this->faker, $manager);
        $populator->addDocument('\Landmarx\Bundle\LandmarkBundle\Document\Category', $this->getFixtureMax('category'));
        
        $populator->execute();
        
        $manager->flush();
    }
    
    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 3;
    }
}
