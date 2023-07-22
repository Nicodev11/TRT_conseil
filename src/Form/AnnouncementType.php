<?php

namespace App\Form;

use App\Entity\Announcement;
use App\Repository\CategoriesRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Range;

class AnnouncementType extends AbstractType
{

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label'=> 'Nom de l\'annonce',
                'attr' => [
                    'class' => 'form-control my-2'
                ]
            ])
            ->add('contract_id', null, [
                'label'=> 'Type de contrat',
                'attr' => [
                    'class' => 'form-control my-2'
                ]
            ])
            ->add('category_id', null, [
                'label'=> 'Catégorie',
                'attr' => ['class' => 'form-control mx-auto my-1'],
                'group_by' => 'parent.name',
                'query_builder' => function(CategoriesRepository $cr)
                
                {
                    return $cr->createQueryBuilder('c')
                        ->where('c.parent IS NOT NULL');
                },
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control my-2',
                    "rows" => "10"
                ]
            ])
            ->add('hours', NumberType::class, [
                'label'=> 'Nombre d\'heures',
                'attr' => [
                    'class' => 'form-control my-2'
                ],
                'constraints' => [
                    new Range([
                        'min' => 1,
                        'max' => 35,
                        'minMessage' => 'Le nombre d\'heures doit être supérieur à 1',
                        'maxMessage' => 'Le nombre d\'heures doit être inférieur à 35',
                    ])
                ]
            ])
            ->add('salary', NumberType::class, [
                'label'=> 'salaire',
                'attr' => [
                    'class' => 'form-control my-2'
                ],
                'constraints' => [
                    new Range([
                        'min' => 1,
                        'max' => 100000,
                        'minMessage' => 'Le salaire doit être supérieur à 1',
                        'maxMessage' => 'Le salaire doit être inférieur à 100000',
                    ])
                ]
            ]);

            $is_consultant = $this->security->isGranted('ROLE_CONSULTANT');

            if ($is_consultant) {
                $builder->add('is_valided', CheckboxType::class, [
                    'label' => ' Valider et mettre en ligne l\'annonce',
                    'required' => false,
                    'attr' => [
                        'class' => 'mx-2 form-check-input',
                        'role' => 'switch',
                        'type' => 'checkbox'
                    ]
                ]);
            }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Announcement::class,
        ]);
    }
}
