<?php

use Broadway\Bundle\BroadwayBundle\BroadwayBundle;
use BroadwaySerialization\SymfonyIntegration\BroadwaySerializationBundle;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;
use Wbits\SoccerTeam\SoccerTeamBundle\SoccerTeamBundle;

class AppKernel extends Kernel
{
    /**
     * {@inheritdoc}
     */
    public function registerBundles(): array
    {
        $bundles = [
            new BroadwayBundle(),
            new SoccerTeamBundle(),
            new FrameworkBundle(),
            new DoctrineBundle(),
            new BroadwaySerializationBundle(),
        ];

        return $bundles;
    }
    /**
     * {@inheritdoc}
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__ . '/config/config_' . $this->getEnvironment() . '.yml');
    }
}
