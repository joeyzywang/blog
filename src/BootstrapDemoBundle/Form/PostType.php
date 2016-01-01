<?php

namespace BootstrapDemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('publishtime', 'datetime')
            ->add('tag')
            ->add('content')
            ->add('note')
//             ->add('author.username')
            ->add('author', 'entity',
            		array(
            				'class' => 'BootstrapDemoBundle:User',
            				'label' => 'Author',
            		)
            	)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BootstrapDemoBundle\Entity\Post'
        ));
    }
}
