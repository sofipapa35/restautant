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
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email', EmailType::class, [
            "label"=>"E-mail *",
            "attr"=>[
                'placeholder'=>'Veuillez saisir votre e-mail'
            ]])
        ->add('prenom', TextType::class, [
            "label"=>"Prénom *",
            "attr"=>[
                'placeholder'=>'Veuillez saisir votre prénom'
            ]])
        ->add('nom', TextType::class, [
            "label"=>"Nom *",
            "attr"=>[
                'placeholder'=>'Veuillez saisir votre nom'
            ]])
        ->add('agreeTerms', CheckboxType::class, [
            "label"=>"Je suis d'accord avec les termes *",
            'mapped' => false,
            'constraints' => [
                new IsTrue([
                    'message' => 'You should agree to our terms.',
                ]),
            ],
        ])
        ->add('plainPassword', RepeatedType::class, [
            'type' => PasswordType::class,
            'mapped' => false,
            'invalid_message' => 'Le mot de passe et la confirmation doivent être identique',
            'required' => true,
            'first_options' => ['label'=>'Mot de passe *', 
            "attr"=> [
                'placeholder' => 'Merci de saisir un mot de passe*'
            ]],
            'second_options' => ['label'=>'Confirmation de mot de passe *',
            "attr"=> [
                'placeholder' => 'Merci de saisir un mot de passe*'
            ]],
            'attr' => ['autocomplete' => 'new-password'],
            'constraints' => [
                new NotBlank([
                    'message' => 'Please enter a password',
                ]),
                new Length([
                    'min' => 8,
                    'minMessage' => 'Your password should be at least {{ limit }} characters',
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
