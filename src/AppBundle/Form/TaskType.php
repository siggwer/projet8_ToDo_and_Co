<?php

/**
 *
 * @category
 * @package
 * @author   Yohann Zaoui <yohannzaoui@gmail.com>
 * @license
 * @link
 * Created by PhpStorm.
 * Date: 01/02/2019
 * Time: 23:14
 */

declare(strict_types=1);

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * Class TaskType
 *
 * @package AppBundle\Form
 */
class TaskType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'title', TextType::class, [
                'label' => 'Titre'
                ]
            )
            ->add(
                'content', TextareaType::class, [
                'label' => 'Contenu'
                ]
            );
    }

}
