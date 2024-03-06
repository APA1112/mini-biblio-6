<?php

namespace App\Form;

use App\Entity\Socio;
use http\Message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class SocioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dni')
            ->add('apellidos')
            ->add('nombre')
            ->add('esDocente')
            ->add('esEstudiante')
            ->add('telefono', TextType::class, [
                'constraints' => [
                    new Assert\Length(9),
                    new Assert\Regex([
                        'pattern' => '/^\d{9}$/',
                        'message' => 'El número de teléfono debe de tener nueve digitos'
                    ])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Socio::class,
        ]);
    }
}
