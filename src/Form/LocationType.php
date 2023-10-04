<?php

namespace App\Form;

use App\Entity\Location;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    public function __construct(private readonly EntityManagerInterface $entityManager){}

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
            ->add('address', TextType::class)
            ->add('nbrRoom', IntegerType::class)
            ->add('description', TextareaType::class)
            ->add('nightPrice', MoneyType::class)
            ->add('area', IntegerType::class)
            ->add('city', TextType::class,  ['attr' => ['list' => 'cities']])
            ->addEventListener(FormEvents::SUBMIT, function (FormEvent $event): void {
                /** @var Location $location */
                $location = $event->getData();
                $form = $event->getForm();

                $con = $this->entityManager->getConnection();
                $sql = 'SELECT ville_nom_reel FROM fixture_city where ville_nom_reel = :city';
                $resultSet = $con->executeQuery($sql, ['city' => $location->getCity()]);
                $results = $resultSet->fetchOne();
                if (!$results) {
                    $form->get("city")->addError(new FormError("City doesn't exist"));
                }
            })
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
