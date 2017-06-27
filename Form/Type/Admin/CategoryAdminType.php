<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 21/05/17
 * Time: 16:02
 */

namespace Miky\Bundle\CategoryBundle\Form\Type\Admin;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryAdminType extends AbstractType
{

    /**
     * @var string
     */
    protected $class;

    public function __construct($class)
    {
        $this->class = $class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("name", TextType::class,array(
                "label" => "miky_core.name"
            ))
            ->add("parent", EntityType::class,array(
                "class" => $this->class,
                "label" => "miky_category.parent_category",
                "choice_label" => "name",
                "placeholder" => "miky_category.no_category",
                "required" => false
            ))
            ->add("description", TextareaType::class,array(
                "label" => "miky_core.description",
                "required" => false
            ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
        ));
    }
}