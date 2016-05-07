<?php
namespace Landmarx\Bundle\FixturesBundle\DataFixtures\ODM\MongoDB;

use \Faker\Factory as FakerFactory;
use \Symfony\Component\Config\FileLocator;
use \Symfony\Component\Yaml\Yaml;
use \Doctrine\Common\Collections\ArrayCollection;
use \Doctrine\Common\DataFixtures\AbstractFixture;
use \Symfony\Component\DependencyInjection\ContainerAwareInterface;
use \Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/** @TODO add FileLocator and i/o */

abstract class DataFixture extends AbstractFixture implements ContainerAwareInterface, OrderedFixtureInterface
{
    /**
     * Container
     *
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Faker
     *
     * @var Generator
     */
    protected $faker;
    
    protected $repository;
    
    protected $document;
    
    /**
     * configuration settings
     * @var ArrayCollection
     */
    private $configs;

    /**
     * config file locator
     * @var FileLocater
     */
    private $locator;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->faker = FakerFactory::create();
        $path = __DIR__ .DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
                DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR .
                'app' . DIRECTORY_SEPARATOR;
        $configDirectories = array(
            __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Resources' . DIRECTORY_SEPARATOR . 'config',
            $path . 'config'
        );
        $this->locator = new FileLocator($configDirectories);
    }

    /**
     * @{inheritdoc}
     */
    public function setContainer(\Symfony\Component\DependencyInjection\ContainerInterface $container = null)
    {
        $this->container = $container;
    }

//    public function __call($method, $arguments)
//    {
//        $matches = array();
//        if (preg_match('/^get(.*)Repository$/', $method, $matches)) {
//            return $this->get('landmarx.repository.'.$matches[1]);
//        }
//
//        return call_user_func_array(array($this, $method), $arguments);
//    }

    /**
     * Get service by id.
     *
     * @param string $id
     *
     * @return object
     */
    protected function get($id)
    {
        return $this->container->get($id);
    }
    
    public function setRepository($repository)
    {
        $this->repository = $repository;
    }
    
    public function getRepository()
    {
        return $this->repository;
    }
    
    public function setDocument($document)
    {
        $this->document = $document;
    }
    
    public function getDocument()
    {
        return $this->document;
    }
    
    /**
     * Get configuration file parameter
     * @param string $parameter
     * @return type
     */
    public function getFixtureMax($parameter)
    {
        if (!$this->configs instanceof ArrayCollection) {
            $this->generateConfigs('parameters.yml', '../../Resources/config');
        }
        
        //var_dump($parameter);
        
        if ($this->configs->contains('landmarx.fixtures.'.$parameter.'.total')) {
            return $this->configs->get('landmarx.fixtures.'.$parameter.'.total');
        } else {
            return $this->configs->get('landmarx.fixtures.'.$parameter);
        }
    }

    /**
     * Generate configuration array
     * @param string $file
     * @param string $path
     * @param bool $retFile
     */
    private function generateConfigs($file, $path = null, $retFile = false)
    {
        $configs = Yaml::parse($this->locator->locate($file, $path, $retFile)[0]);

        $this->configs = new ArrayCollection($configs['parameters']);
    }
}
