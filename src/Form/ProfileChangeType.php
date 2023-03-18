<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class ProfileChangeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('phone', TextType::class, [
                'attr' => [
                    'class' => 'form-input',
                    'id' => 'phone',
                    'placeholder' => '+70000000000',
                    'required' => 'true'
                ],
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-input',
                    'id' => 'mail',
                    'required' => 'true'
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'id' => 'password',
                    'class' => 'form-input',
                    'placeholder' => 'Выберите пароль',
                ],
                'constraints' => [
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Ваш пароль не должен быть меньше чем {{ limit }} символов',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('replyPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'id' => 'passwordReply',
                    'class' => 'form-input',
                    'placeholder' => 'Выберите пароль',
                ],
                'constraints' => [
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Ваш пароль не должен быть меньше чем {{ limit }} символов',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('avatar', FileType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'Выберите аватар',
                'attr' => [
                    'class' => 'Profile-file form-input',
                    'id' => 'avatar',
                ],
            ])
            ->add('name', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-input',
                    'id' => 'name',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
