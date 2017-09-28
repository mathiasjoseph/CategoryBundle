<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 21/05/17
 * Time: 16:02
 */

namespace Miky\Bundle\CategoryBundle\Form\Type;


use Doctrine\ORM\EntityRepository;
use Miky\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CategoryAdminType  extends AbstractResourceType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $id = $options['data']->getId();
        $builder
            ->add("name", TextType::class,array(
                "label" => "miky_core.name"
            ))
            ->add("description", TextareaType::class,array(
                "label" => "miky_core.description",
                "required" => false
            ))
            ->add("parent", EntityType::class,array(
                "class" => $this->dataClass,
                "label" => "miky_category.parent_category",
                "choice_label" => "name",
                "placeholder" => "miky_category.no_category",
                "required" => false,
                'query_builder' => function (EntityRepository $er) use ($id) {
                    $q = $er->createQueryBuilder('c');
                    if ($id !== null) {
                        $q->setParameter("id", $id)
                            ->where('c.id != :id');
                    }
                    return $q;
                },
            ))
            ->add("asCategoryGroup", CheckboxType::class,array(
                "label" => "miky_category.use_as_category_group",
                "required" => false
            ))
            ->add("icon", TextType::class,array(
                "label" => "miky_core.icon",
                "required" => false
            ))
            ->add("slug", TextType::class,array(
                "label" => "miky_core.slug",
                "required" => false
            ))
            ->add("position", IntegerType::class,array(
                "label" => "miky_category.position",
                "required" => false
            ))

        ;
    }

}