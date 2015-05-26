<?php



namespace MagicT\PadelReservatieBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;


class VeldAdmin extends Admin
{
    protected $baseRouteName = 'veld'; 
    protected $baseRoutePattern = 'veld';

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('naam','text',array(
                'label'=>'Naam',
                'editable'=>true
                ))
            ->add('startuur', 'time', array(
                'label'=>'Startuur',
                'editable'=>true
                ))
            ->add('beschikbaar','boolean',array(
                'label'=>'Beschikbaar',
                'editable'=>true
                ))
            ->add('volgorde','integer',array(
                'label'=>'Volgorde',
                'editable'=>true
                ))
            ->add('typeVeld')
        ;

        
    }

    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
            ->add('naam')
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Gegevens')
                ->add('naam','text',array(
                    'label'=>'Naam',
                    'required'=>true
                    ))
                ->add('startuur', 'time', array(
                'label'=>'Startuur',
                'required'=>true
                ))
            ->add('typeveld')
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
                ->add('startuur', 'time', array(
                'label'=>'Startuur',
                'required'=>true
                ))
            ->add('typeVeld', 'sonata_type_model', array())
            ->add('beschikbaar','checkbox',array(
                'label'=>'Beschikbaar'
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
