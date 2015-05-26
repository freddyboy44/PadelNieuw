<?php
// src/MagicT/PadelUserBundle/CategorieAdmin.php

namespace MagicT\PadelUserBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class LidmaatschapAdmin extends Admin
{
    protected $baseRouteName = 'lidmaatschap'; 
    protected $baseRoutePattern = 'lidmaatschap';
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Persoonlijk')
                ->add('Naam', 'text', array(
                    'label' => 'Naam',
                    'required' => true,

                    ))
                ->add('Periode','text',array(
                    'label' => 'Periode',
                    'required' => true
                    ))
                ->add('Prijs','number',array(
                    'label' => 'Prijs'
                    ))
                ->add('Zichtbaar','checkbox',array(
                    'label' => 'Zichtbaar',
                    'required' => false
                    ))
                ->setHelps(array(
                    'periode' => 'De periode van het abonnement (voorbeeld, 2 dagen is P2D. 2 seconden is PT2S. Zes jaar en 5 minuten is P6YT5M.',
                ))

        ;
    }

    
    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('Naam')
            ->add('Zichtbaar')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('Naam')
            ->add('Periode')
            ->add('Zichtbaar', 'boolean', array(
                'editable' => true
                ))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array()
                )
            ))
        ;
    }
}
