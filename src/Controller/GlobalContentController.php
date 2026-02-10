<?php

namespace OHMedia\GlobalContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Admin]
class GlobalContentController extends AbstractController
{
    #[Route('/global-content', name: 'global_content_index')]
    public function index(): Response
    {
        // TODO: list out configured global content in alphabetical order
    }

    #[Route('/global-content/{id}', name: 'global_content_edit')]
    public function edit(): Response
    {
        // TODO: verify ID is a valid configured global content
        // and create a form to edit it
    }
}
