<?php

namespace AppBundle\Form;

use AppBundle\Entity\TagName;
use AppBundle\Service\FieldUtils;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TagNameType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'required' => true
            ])
            ->add('description', TextType::class, [
                'required' => false
            ])
            ->add('example', TextType::class, [
                'required' => false
            ])
            ->add('showInSearchResults', CheckboxType::class, [
                'required' => false
            ]);
        if (!$options['isEdit']) {
            $fieldUtils = new FieldUtils();
            $builder->add('type', ChoiceType::class, [
                'required' => true,
                'expanded' => true,
                'multiple' => false,
                'choices' => $fieldUtils->getFieldNameDescriptions(),
            ]);
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => TagName::class
            ])
            ->setRequired(['isEdit']);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_tagname';
    }


}
