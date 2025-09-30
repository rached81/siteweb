<?php

namespace App\Form;

use App\Entity\Content;
use App\Entity\Scope;
use App\Repository\ScopeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
class ContentType extends AbstractType
{
    private $security;
    private $entityManager;
    /**
     * Constructor
     *
     * @param Security $security
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        Security               $security,
        EntityManagerInterface $entityManager
    )
    {

        $this->security = $security;
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('scope', EntityType::class, ["required" => true, "attr" => ["class" => "form-control",],
                'placeholder' => 'Choisir rubrique',
                'class' => Scope::class,
                'query_builder' => function (ScopeRepository $repo) {
                    return $repo->scopeProfileQueryBuilder();
                },
                'choice_label' => 'name',
            ])
//            // Pré-sélection seulement en création
//    ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($options) {
//        $content = $event->getData();
//        if (!$content || $content->getId()) {
//            return; // édition => ne pas toucher
//        }
//        if (!$content->getScope() && $options['current_scope'] instanceof Scope) {
//            $event->getForm()->get('scope')->setData($options['current_scope']);
//        }
//    })
            ->add('title', TextType::class, ['required' => true])
            ->add('title', TextType::class, ['required' => true])
            ->add('intro')
->add('body', TextareaType::class, [])

            ->add('tags', TextType::class,
                ['attr' => ['data-role' => "tagsinput", 'data-tag-class' => "badge badge-primary", 'class' => "form-control"
                ]])
            ->add('published_date', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('published', CheckboxType::class, ["required" => false, 'attr' => ["class" => "form-check-input", 'style' => "height:20px; width: 40px; "], "row_attr" => ['class' => 'form-switch pt-2', 'style' => "padding-left: 10px!important;"]])
            ->add('fullWidth', CheckboxType::class, ["required" => false, 'attr' => ["class" => "form-check-input", 'style' => "height:20px; width: 40px; "], "row_attr" => ['class' => 'form-switch pt-2', 'style' => "padding-left: 10px!important;"]])
            ->add('picture', FileType::class, [
                'mapped' => false,
                'required' => false,
               'label' => 'image',
               'attr' =>
        ['data-tag-class' => "badge badge-primary", 'class' => "form-control"],

            ])
//            ->add('picture', CollectionType::class, [
//                'entry_type' => ArticleImageType::class,
//                'allow_add' => true, 'allow_delete' => true, 'by_reference' => false,
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Content::class,
            'translation_domain' => 'forms',         // <= domaine des libellés/helps/placeholders
            'label_format' => 'form.content.%name%', // <= clé par défaut de chaque champ
//            'current_scope' => null,
        ]);
    }
}
