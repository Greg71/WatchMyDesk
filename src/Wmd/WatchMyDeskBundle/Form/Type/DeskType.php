<?php

namespace Wmd\WatchMyDeskBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Wmd\WatchMyDeskBundle\Form\Type\DeskPictureType;


class DeskType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('summary')
            ->add('description');
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Wmd\WatchMyDeskBundle\Entity\Desk',
        );
    }

    public function getName()
    {
        return 'Desk';
    }
}