<?php

namespace App\Form;

use App\Entity\Booking;
use App\Entity\RoomType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('checkInAt', )
            ->add('checkOutAt')
            ->add('adults')
            ->add('childs')
            ->add('paid')
            ->add('salesChannel')
            ->add('country')
            ->add('isGuided')
            ->add('roomNumber')
            ->add('roomType', EntityType::class, [
                'class' => RoomType::class,
                'choice_label' => 'name',
                'placeholder' => 'Choose a room type'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
