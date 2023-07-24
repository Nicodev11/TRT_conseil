<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('firstname', TextType::class, ['attr' => ['class' => 'form-control']])
        ->add('lastname', TextType::class, ['attr' => ['class' => 'form-control']])
        ->add('adress', TextType::class, ['attr' => ['class' => 'form-control']])
        ->add('city', ChoiceType::class, [
            'attr' => ['class' => 'form-select'],
            'required' => false,
            'constraints' => [
                new NotBlank(),
            ],

        ])
        ->add('zip', TextType::class, [
            'attr' => [
                'class' => 'form-control',
                'maxlength' => 5
            ],
            'constraints' => [
                new Regex ([
                    'pattern' => '/^[0-9]{5}$/',
                    'message' => 'Le code postal n\'est pas valide'
                ]),
            ]
        ])
        ->add('email', EmailType::class, [
            'attr' => ['class' => 'form-control mb-3']
        ])
        ->add('plainPassword',  RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => 'Les mots de passes saisis ne sont pas identiques.',
            'options' => ['attr' => ['autocomplete' => 'new-password', 'class' => 'form-control']],
            'required' => true,
            'first_options'  => ['label' => 'Mot de passe'],
            'second_options' => ['label' => 'Confirmation du mot de passe'],
            'mapped' => false,
            'constraints' => [
                new Regex([
                    'pattern' => '"^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"',
                    'message' => 'Votre mot de passe doit comporter au minimum 8 caractères dont une majuscule, 
                                  une minuscule, un chiffre et un caractère spècial'
                ])
            ],
        ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'J\'accepte les termes CGV',
                'attr' => ['class' => 'ms-2'],
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les termes CGV.',
                    ]),
                ],
            ])
            ->add('phone', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new Regex([
                        'pattern' => '/^0[1-9]([-. ]?[0-9]{2}){4}$/',
                        'message' => 'Le numéro de téléphone n\'est pas valide'
                    ])
                ]
            ])
        ;

        $builder->get('city')->resetViewTransformers();
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
