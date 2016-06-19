<?php

namespace Kishron\ConfigBundle\Twig;


class ConfigExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            //new \Twig_SimpleFilter('price', array($this, 'priceFilter')),
        );
    }
    
    public function getFunctions()
    {
        return array(
            //new \Twig_SimpleFunction('test', array($this, 'testFunction')),
        );
    }

    public function getName()
    {
        return 'conf_extension';
    }
}


