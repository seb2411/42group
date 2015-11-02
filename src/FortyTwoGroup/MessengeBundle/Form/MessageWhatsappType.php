<?php
namespace FortyTwoGroup\MessengeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageWhatsappType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', 'hidden', array(
                'data' => '1'
            ))
            ->add('exclusive', 'checkbox', array(
                'label' => 'If undeliverable, try Sms: ',
                'attr' => array(
                    'name' => 'my-checkbox',
                    'data-on-text' => 'Yes',
                    'data-off-text' => 'No'
                ),
                'required' => false
            ))
            ->add('numbers', 'textarea', array(
                'label' => 'Mobile numbers:',
                'attr' => array(
                    'class' => 'form-control'
                ),
                'required' => false
            ))
            ->add('attachment', 'file', array(
                'label' => 'Upload numbers from txt file:',
                'mapped' => false,
                'required' => false
            ))
            ->add('sender', 'text', array(
                'label' => 'Sender:',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Whatsapp number or Identifier'
                ),
            ))
            ->add('message', 'textarea', array(
                'label' => 'Message content:',
                'max_length' => '300'
            ))
            ->add('reset', 'reset', array(
                'label' => 'Reset',
                'attr' => array('class' => 'btn btn-default pull-left')
            ))

            ->add('send', 'submit', array(
                'label' => 'Send',
                'attr' => array('class' => 'btn btn-success pull-right')
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FortyTwoGroup\MessengeBundle\Document\Message',
            'validation_groups' => array('whatsapp')
        ));
    }

    public function getName()
    {
        return 'messageWhatsapp';
    }
}
