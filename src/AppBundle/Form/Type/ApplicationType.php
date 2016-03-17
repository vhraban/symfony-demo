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
        $sexChoices = $this->translateToChoices(Application::$allowedSex);
        $countryChoices = $this->translateToChoices(
            $this->restCountriesClient->getEuropeanCountries()
        );

        $builder->add('name', TextType::class)
                ->add('sex', ChoiceType::class, [
                        "choices" => $sexChoices,
                        "choices_as_values" => true,
                        "expanded" => true,
                        "invalid_message" => "Invalid sex"
                    ]
                )
                ->add('age', IntegerType::class)
                ->add('country', ChoiceType::class, [
                        "choices" => $countryChoices,
                        "choices_as_values" => true,
                        "invalid_message" => "Invalid country",
                        "empty_data" => null,
                        'empty_value' => "Please select"
                    ]
                )
                ->add('save', SubmitType::class);
    }

    /**
     * Translate a given array into a format understandable by choiceType
     * choices config option
     *
     * In put case we want to keys be the same as values,
     * not auto-incremental values
     *
     * @param array $source Source array
     *
     * @return array Translated array
     */
    protected function translateToChoices(array $source)
    {
        return array_combine($source, $source);
    }
}
