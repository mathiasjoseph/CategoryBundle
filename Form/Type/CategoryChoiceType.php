<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 20/06/17
 * Time: 21:18
 */

namespace Miky\Bundle\CategoryBundle\Form\Type;


use Miky\Bundle\CategoryBundle\Model\Category;
use Miky\Bundle\CategoryBundle\Provider\CategoryProvider;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryChoiceType extends AbstractType
{
    /**
     * @var CategoryProvider
     */
    protected $categoryProvider;

    /**
     * CategoryChoiceType constructor.
     * @param CategoryProvider $categoryProvider
     */
    public function __construct(CategoryProvider $categoryProvider)
    {
        $this->categoryProvider = $categoryProvider;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired("category_alias");
        $resolver->setDefaults(array(
            "placeholder" => "miky_category.no_category",
            'choice_label' => "name",
            'class' => function (Options $options) {

                return $this->categoryProvider->getClass($options["category_alias"]);
            }
        ));
    }


    public function getParent()
    {
        return EntityType::class;
    }
}