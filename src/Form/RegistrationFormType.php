<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('phone', TextType::class, [
                // 'label' => 'Телефон',
                'attr' => [
                    'class' => 'form-input',
                    'id' => 'phone',
                    'placeholder' => '+70000000000',
                    'required' => 'true'
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-mail',
                'attr' => [
                    'class' => 'form-input',
                    'id' => 'mail',
                    'placeholder' => 'send@test.test',
                    'required' => 'true'
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,

                'attr' => [
                    'autocomplete' => 'new-password',
                    'id' => 'password',
                    'class' => 'form-input',
                    'placeholder' => 'Выберите пароль',
                    'required' => 'true'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Введите пароль',
                    ]),
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

                'attr' => [
                    'autocomplete' => 'new-password',
                    'id' => 'passwordReply',
                    'class' => 'form-input',
                    'placeholder' => 'Выберите пароль',
                    'required' => 'true'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Введите пароль',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Ваш пароль не должен быть меньше чем {{ limit }} символов',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
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
