<?php
// src/Controller/Back/CkeditorUploadController.php
namespace App\Controller\Back;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

final class CkeditorUploadController extends AbstractController
{
    //back/{_locale}/content
    #[Route('/back/upload/ckeditor', 'app_upload_ckeditor')]
    public function __invoke(Request $request, SluggerInterface $slugger): JsonResponse
    {
        $file = $request->files->get('upload'); // <-- champ attendu par CKEditor
        if (!$file || !$file->isValid()) {
            return $this->json(['error' => ['message' => 'Fichier manquant ou invalide']], 400);
        }

        // limites simples
        if ($file->getSize() > 5 * 1024 * 1024) {
            return $this->json(['error' => ['message' => 'Max 5MB']], 400);
        }
        $allowed = ['image/jpeg','image/png','image/gif','image/webp'];
        if (!in_array($file->getMimeType(), $allowed, true)) {
            return $this->json(['error' => ['message' => 'Type non autorisé']], 400);
        }

        $safe = $slugger->slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $newName = $safe.'-'.uniqid().'.'.$file->guessExtension();

        $targetDir = $this->getParameter('kernel.project_dir').'/public/uploads/ckeditor';
        if (!is_dir($targetDir)) {
            @mkdir($targetDir, 0775, true);
        }
        $file->move($targetDir, $newName);

        // Réponse attendue par SimpleUploadAdapter
        return $this->json(['url' => '/uploads/ckeditor/'.$newName]);
    }
}
