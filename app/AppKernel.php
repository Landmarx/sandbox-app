<?php

class AppKernel extends \Landmarx\Bundle\CoreBundle\Kernel\Kernel
{
    /**
     * {@inheritdoc}
     */
    public function registerBundles()
    {
        $bundles = array();

        return array_merge($bundles, parent::registerBundles());
    }
    
    /**
     * {@inheritdoc}
     */
    public function registerContainerConfiguration(\Symfony\Component\Config\Loader\LoaderInterface $loader)
    {
        $dir = $this->getAppDir();
        $loader->load($dir.'/config/config_'.$this->environment.'.yml');
        
        if (is_file($file = $dir.'/config/config_'.$this->environment.'.local.yml')) {
            $loader->load($file);
        }
    }
}
