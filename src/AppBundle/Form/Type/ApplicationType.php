<?php
namespace AppBundle\Form\Type;

use AppBundle\DependencyInjection\RestCountriesClient;
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
     * @var RestCountriesClient a client to talk to RestCountries API
     */
    protected $restCountriesClient;

    /**
     * A constructor, sets up dependencies
     *
     * @param RestCountriesClient $restCountriesClient
     */
    public function __construct(RestCountriesClient $restCountriesClient)
    {
        $this->restCountriesClient = $restCountriesClient;
    }

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
                ->add('country', ChoiceType::class, [
                        "choices" => $this->restCountriesClient->getEuropeanCountries(),
                    ]
                )
                ->add('save', SubmitType::class);
    }
}
