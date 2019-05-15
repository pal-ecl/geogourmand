<?php
/**
 * Created by PhpStorm.
 * User: Wizpaul
 * Date: 03/05/2019
 * Time: 13:59
 */

namespace App\Form;

use App\Entity\Specialty;
use App\Entity\Tag;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Controller\AppController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OptionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $categories = ['Sucré' => 'Sucré', 'Salé' => 'Salé', 'entrée' => 'Entrée', 'plat' => 'Plat', 'dessert' => 'Dessert'];

        $builder
            ->add('Tags', ChoiceType::class, array(
                'choices' => $categories,
                'multiple' => true,
                'expanded' => true
            ))
            ->add("Envoyer", SubmitType::class, ["attr" => ["class" => "btn btn-sm btn-info"]]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tag::class,
        ]);
    }
}
