<?php
// src/MagicT/PadelUserBundle/CategorieAdmin.php

namespace MagicT\PadelUserBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class LidmaatschapTransactieAdmin extends Admin
{
    protected $baseRouteName = 'lidmaatschaptransactie'; 
    protected $baseRoutePattern = 'lidmaatschaptransactie';
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Lid')
                ->add('lidmaatschap')
                ->add('padelUser')
                ->add('DatumGeldig','date',array(
                    'required'=>true,
                    'data' => new \DateTime(),
                    'widget' => 'single_text'
                    ))
                ->end()

        ;
    }

    
    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('lidmaatschap')
            ->add('padelUser')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('padelUser')
            ->add('lidmaatschap')
            
        ;
    }
}
