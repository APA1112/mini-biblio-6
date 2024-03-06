<?php

namespace App\Form;

use App\Entity\Libro;
use App\Entity\Socio;
use App\Repository\LibroRepository;
use http\Message;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class SocioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dni', TextType::class, [
                'label'=>'DNI'
            ])
            ->add('apellidos', TextType::class, [
                'label'=>'Apellidos'
            ])
            ->add('nombre', TextType::class, [
                'label'=>'Nombre'
            ])
            ->add('esDocente')
            ->add('esEstudiante')
            ->add('telefono', TextType::class, [
                'required'=>false,
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
