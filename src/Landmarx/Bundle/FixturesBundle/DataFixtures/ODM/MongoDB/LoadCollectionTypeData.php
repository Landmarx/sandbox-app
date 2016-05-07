<?php
namespace Landmarx\Bundle\FixturesBundle\DataFixtures\ODM\MongoDB;

use Doctrine\Common\Persistence\ObjectManager;

class LoadCollectionTypeData extends DataFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $populator = new \Faker\ORM\Doctrine\Populator($this->faker, $manager);
        $populator->addDocument('\Landmarx\Bundle\CollectionBundle\Document\Type', $this->getFixtureMax('collection_type'));
        
        $populator->execute();
        
        $manager->flush();
    }
    
    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 5;
    }
}
