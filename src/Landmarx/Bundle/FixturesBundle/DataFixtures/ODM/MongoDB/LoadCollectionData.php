<?php
namespace Landmarx\Bundle\FixturesBundle\DataFixtures\ODM\MongoDB;

use Doctrine\Common\Persistence\ObjectManager;

class LoadCollectionData extends DataFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $populator = new \Faker\ORM\Doctrine\Populator($this->faker, $manager);
        $populator->addDocument('\Landmarx\Bundle\CollectionBundle\Document\Collection', $this->getFixtureMax('collection'));
        
        $populator->execute();
        
        $manager->flush();
    }
    
    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 6;
    }
}
