<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 21/05/17
 * Time: 16:02
 */

namespace Miky\Bundle\CategoryBundle\Form\Type\Admin;


use Miky\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CategoryAdminType  extends AbstractResourceType
{


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

}