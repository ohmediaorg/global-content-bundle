<?php

namespace OHMedia\GlobalContentBundle\Controller;

use OHMedia\BackendBundle\Form\MultiSaveType;
use OHMedia\BackendBundle\Routing\Attribute\Admin;
use OHMedia\GlobalContentBundle\Entity\GlobalContent;
use OHMedia\GlobalContentBundle\Security\Voter\GlobalContentVoter;
use OHMedia\GlobalContentBundle\Service\GlobalContentProvider;
use OHMedia\WysiwygBundle\Form\Type\WysiwygType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Admin]
class GlobalContentController extends AbstractController
{
    public function __construct(private GlobalContentProvider $globalContentProvider)
    {
    }

    #[Route('/global-content', name: 'global_content_index', methods: ['GET'])]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted(
            GlobalContentVoter::INDEX,
            new GlobalContent(),
            'You cannot access the list of global content.'
        );

        return $this->render('@OHMediaGlobalContent/global_content_index.html.twig', [
            'global_content' => $this->globalContentProvider->config(),
            'attributes' => $this->getAttributes(),
        ]);
    }

    #[Route('/global-content/{id}/edit', name: 'global_content_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        string $id,
    ): Response {
        if (!$this->globalContentProvider->exists($id)) {
            throw $this->createNotFoundException();
        }

        $this->denyAccessUnlessGranted(
            GlobalContentVoter::INDEX,
            new GlobalContent(),
            'You cannot edit this global content.'
        );

        $formBuilder = $this->createFormBuilder();

        $label = $this->globalContentProvider->label($id);

        $formBuilder->add('wysiwyg', WysiwygType::class, [
            'label' => $label,
            'data' => $this->globalContentProvider->get($id),
        ]);

        $formBuilder->add('save', MultiSaveType::class, [
            'add_another' => false,
        ]);

        $form = $formBuilder->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $this->globalContentProvider->set($id, $form->get('wysiwyg')->getData());

                $this->addFlash('notice', 'The global content was updated successfully.');

                return $this->redirectForm($id, $form);
            }

            $this->addFlash('error', 'There are some errors in the form below.');
        }

        return $this->render('@OHMediaGlobalContent/global_content_edit.html.twig', [
            'form' => $form->createView(),
            'global_content_label' => $label,
        ]);
    }

    private function redirectForm(string $id, FormInterface $form): Response
    {
        $clickedButtonName = $form->getClickedButton()->getName() ?? null;

        if ('keep_editing' === $clickedButtonName) {
            return $this->redirectToRoute('global_content_edit', [
                'id' => $id,
            ]);
        } else {
            return $this->redirectToRoute('global_content_index');
        }
    }

    private function getAttributes(): array
    {
        return [
            'edit' => GlobalContentVoter::EDIT,
        ];
    }
}
