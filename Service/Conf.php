<?php

namespace Kishron\ConfigBundle\Service;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Conf
 *
 * @author juan
 */
class Conf {
    
    var $em;
    var $activeProfile = null;
    var $activeModule = null;
    var $activeCategory = null;
    
    public function __construct($doctrine) {
        $this->em = $doctrine->getManager();
    }
    
    public function getModules() {
        $modules = $this->em->getRepository('ConfigBundle:ConfModule')->findAll();
        return $modules;
    }
    
    public function getProfiles() {
        $profiles = $this->em->getRepository('ConfigBundle:ConfProfile')->findAll();
        return $profiles;
    }
    
    public function setActiveModule($codeModule) {
        $success = false;
        $modules = $this->getModules();
        foreach($modules as $module) {
            if ($module->getCode() === $codeModule) {
                $this->activeModule = $module;
                $success = true;
            }
        }
        if (!$success) {
            throw new \Exception('Code module not found, try getModules() to know the avaible modules.');
        }
        return $this;
    }
    
    public function setActiveProfile($codeProfile) {
        $success = false;
        $profiles = $this->getProfiles();
        foreach($profiles as $profile) {
            if ($profile->getCode() === $codeProfile) {
                $this->activeProfile = $profile;
                $success = true;
            }
        }
        if (!$success) {
            throw new \Exception('Code profile not found, try getProfiles() to know the avaible profiles.');
        }
        return $this;
    }
    
    public function setActiveCategory($codeCategory) {
        $success = false;
        if ($this->activeModule === null) {
            throw new \Exception('A module must be selected as active.');
        }
        foreach($this->activeModule->getCategories() as $category) {
            if ($category->getCode() === $codeCategory) {
                $this->activeCategory = $category;
                $success = true;
            }
        }
        if (!$success) {
            throw new \Exception($codeCategory . '  is not a category from ' . $this->activeModule->getName() . ' module (' . $this->activeModule->getCode() . ').');
        }
        return $this;
    }
    
    public function getParameters($array = true) {
        $parameters = array();
        if ($this->activeModule === null) {
            // all parameters (all modules)
            $modules = $this->getModules();
            foreach ($modules as $module) {
                foreach ($module->getCategories() as $category) {
                    foreach ($category->getParameters() as $parameter) {
                        if ($array) {
                            $parameters[$parameter->getName()] = $this->_parameterToArray($parameter);
                        } else {
                            $parameters[] = $parameter;
                        }
                    }
                }
            }
        } else {
            if ($this->activeCategory === null) {
                // parameters from a specific module
                foreach ($this->activeModule->getCategories() as $category) {
                    foreach ($category->getParameters() as $parameter) {
                        if ($array) {
                            $parameters[$parameter->getName()] = $this->_parameterToArray($parameter);
                        } else {
                            $parameters[] = $parameter;
                        }
                    }
                }
            } else {
                // parameters from a specific category
                foreach ($this->activeCategory->getParameters() as $parameter) {
                    if ($array) {
                        $parameters[$parameter->getName()] = $this->_parameterToArray($parameter);
                    } else {
                        $parameters[] = $parameter;
                    }
                }
            }
        }
        return $parameters;
    }
    
    public function getParameter($nameParameter, $array = true) {
        $parameter = $this->em->getRepository('ConfigBundle:ConfParameter')->findOneBy(array(
            'name' => $nameParameter
        ));
        if ($array) {
            return $this->_parameterToArray($parameter);
        } else {
            return $parameter;
        }
    }
    
    public function getActiveModule() {
        return $this->activeModule;
    }

    public function getActiveCategory() {
        return $this->activeCategory;
    }

    private function _parameterToArray($parameter) {
        if ($parameter) {
            $value = null;
            if ($this->activeProfile) {
                $value = $parameter->getValue($this->activeProfile->getCode());
            } else {
                $value = $parameter->getValues();
            }
            $value = $this->_valueToArray($value);
            $parameterArray = array(
                'id' => $parameter->getId(),
                'name' => $parameter->getName(),
                'description' => $parameter->getDescription(),
                'value' => $value, // $parameter->getValue(),
                'module' => array(
                    'id' => $parameter->getCategory()->getModule()->getId(),
                    'name' => $parameter->getCategory()->getModule()->getName(),
                ),
                'category'=> array(
                    'id' => $parameter->getCategory()->getId(),
                    'name' => $parameter->getCategory()->getName(),
                )
            );
        } else {
            $parameterArray = null;
        }
        return $parameterArray;
    }
    
    private function _valueToArray($value) {
        if ($value) {
            if (get_class($value) === 'Doctrine\ORM\PersistentCollection') {
                $valuesArray = null;
                foreach ($value as $val) {
                    $valuesArray[] = $this->_valueToArray($val);
                }
                $valueArray = $valuesArray;
            } else {
                $valueArray = array(
                    'id' => $value->getId(),
                    'value' => $value->getValue()
                );
            }
        } else {
            $valueArray = null;
        }
        return $valueArray;
    }
    
    public function toJson($pretty = false) {
        $allStructure = array();
        $modules = $this->getModules();
        foreach ($modules as $module) {
            
            $categories = array();
            foreach ($module->getCategories() as $category) {
                
                $parameters = array();
                foreach ($category->getParameters() as $parameter) {
                    $parameters[] = array(
                        'id'    => $parameter->getId(),
                        'name'  => $parameter->getName(),
                        'description' => $parameter->getDescription(),
                        
                    );
                }
                $categories[] = array(
                    'id' => $category->getId(),
                    'name'=> $category->getName(),
                    'parameters' => $parameters
                );
            }
            $allStructure[] = array(
                'id' => $module->getId(),
                'name'=> $module->getName(),
                'categories' => $categories
            );
        }
        
        
        return json_encode($allStructure, $pretty ? JSON_PRETTY_PRINT : 0);
    }

}
