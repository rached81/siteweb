<?php

namespace App\Controller\Back;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class CkUploadController extends AbstractController
{
    /**
     * @Route("/back/ckeditor/upload", name="ck_upload", methods={"POST"})
     */
    public function upload(Request $request, SluggerInterface $slugger): JsonResponse {
        $file = $request->files->get('upload'); // SimpleUploadAdapter → "upload"
        if (!$file) { return new JsonResponse(['error' => ['message' => 'No file']], 400); }

        $safe = $slugger->slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $new  = $safe.'-'.uniqid().'.'.$file->guessExtension();
        $file->move($this->getParameter('kernel.project_dir').'/public/uploads/files', $new);

        // Réponse attendue par SimpleUploadAdapter
        return new JsonResponse([ 'url' => '/uploads/files/'.$new ]);
    }

}
