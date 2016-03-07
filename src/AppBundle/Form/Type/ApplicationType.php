<?php
namespace AppBundle\Form\Type;

use AppBundle\Entity\Application;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ApplicationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class)
                ->add('sex', ChoiceType::class, [
                        "choices" => Application::$allowedSex,
                        "expanded" => true
                    ]
                )
                ->add('age', IntegerType::class)
                ->add('country', TextType::class)
                ->add('save', SubmitType::class);
    }
}
