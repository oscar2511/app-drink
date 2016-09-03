<?php

namespace DrinkBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PedidoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero')

            ->add('fecha', 'datetime')
            ->add('subTotal')
            ->add('total')
            ->add('calle')
            ->add('nro')
            ->add('latitud')
            ->add('longitud')
            ->add('telefono')
            ->add('dirReferencia')

            ->add('fechaUpdate', 'datetime')
            ->add('dispositivo')
            ->add('estado')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DrinkBundle\Entity\Pedido'
        ));
    }
}
