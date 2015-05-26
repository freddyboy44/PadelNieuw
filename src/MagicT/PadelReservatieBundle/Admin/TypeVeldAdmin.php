<?php



namespace MagicT\PadelReservatieBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;


class TypeVeldAdmin extends Admin
{
    protected $baseRouteName = 'typeveld'; 
    protected $baseRoutePattern = 'typeveld';

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('naam','text',array(
                'label'=>'Naam',
                'editable'=>true
                ))
            ->add('aantalspelers', 'integer', array(
                'label'=>'Aantal spelers',
                'editable'=>true
                ))
            ->add('beschikbaar','boolean',array(
                'label'=>'Beschikbaar',
                'editable'=>true
                ))
        ;

        
    }

    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
            ->add('beschikbaar')
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Gegevens')
                ->add('naam','text',array(
                    'label'=>'Naam'
                    ))
                ->add('aantalspelers', 'integer', array(
                'label'=>'Aantal spelers'
                ))
            ->add('beschikbaar','checkbox',array(
                'label'=>'Beschikbaar'
                ))
            ->end()
            
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Gegevens')
                 ->add('naam','text',array(
                'label'=>'Naam',
                'required'=>true
                ))
            ->add('aantalspelers', 'integer', array(
                'label'=>'Aantal spelers'
                ))
            ->add('beschikbaar','checkbox',array(
                'label'=>'Beschikbaar',
                'required'=>false
                ))
            ->end()
        ;
        
    
    }

    public function getTemplate($name)
{
    return parent::getTemplate($name);
    switch ($name)
    {
        default:

            case 'list':
                dump(parent::getTemplate($name));
                die("haha");
                return 'MyBundle:Admin:list.html.twig';

            break;

            return parent::getTemplate($name);

        break;
    }
}
}
