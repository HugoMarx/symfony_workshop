<?php

namespace App\Form;

use App\Entity\Ticket;
use App\Entity\TicketPriority;
use App\Entity\TicketStatus;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('created')
            ->add('modified')
            ->add('completed')
            ->add('author', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('status', EntityType::class, [
                'class' => TicketStatus::class,
                'choice_label' => 'id',
            ])
            ->add('priority', EntityType::class, [
                'class' => TicketPriority::class,
                'choice_label' => 'id',
            ])
            ->add('assignee', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ticket::class,
        ]);
    }
}
