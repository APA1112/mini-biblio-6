<?php

namespace App\Form;

use App\Entity\Autor;
use App\Entity\Editorial;
use App\Entity\Libro;
use App\Entity\Socio;
use App\Repository\AutorRepository;
use App\Repository\EditorialRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LibroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titulo')
            ->add('anioPublicacion', IntegerType::class, [
                'label'=>'Año de publicación'
            ])
            ->add('paginas')
            ->add('isbn')
            ->add('precioCompra', MoneyType::class, [
                'divisor'=>100
            ])
            ->add('editorial', EntityType::class, [
                'label'=>'Editorial',
                'class'=>Editorial::class,
                'choice_label'=>'nombre',
                'query_builder'=>function (EditorialRepository $editorialRepository) {
                    return $editorialRepository->createQueryBuilder('e')
                        ->orderBy('e.nombre', 'ASC');
                }
            ])
            ->add('autores', EntityType::class, [
                'class'=>Autor::class,
                'expanded'=>false,
                'multiple'=>true,
                'query_builder'=>function (AutorRepository $autorRepository) {
                    return $autorRepository->createQueryBuilder('a')
                        ->orderBy('a.nombre', 'ASC')
                        ->addOrderBy('a.apellidos', 'ASC');
                },
                'choice_label'=>function (Autor $autor) {
                    return $autor->getNombre().' '.$autor->getApellidos();
                }
            ])
            ->add('socio', EntityType::class, [
                'required'=>false,
                'class'=>Socio::class,
                'expanded'=>false,
                'choice_label'=>function (Socio $socio) {
                    return $socio->getApellidos() .','.$socio->getNombre().' '.($socio->getEsDocente()==1?'(docente)':'');
                },
                'placeholder'=>'No prestado'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Libro::class,
        ]);
    }
}
