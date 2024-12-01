<?php

namespace App\Controller;

use App\Repository\EtudiantsRepository;
use App\Repository\NoteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Helper\JsonHelper;

class NotesController extends AbstractController
{
    private $etudiantRepository;
    private $noteRepository;

    public function __construct(EtudiantsRepository $etudiantRepository, NoteRepository $noteRepository)
    {
        $this->etudiantRepository = $etudiantRepository;
        $this->noteRepository = $noteRepository;
    }
    #[Route('/api/resultat', name: 'get_resultat_general', methods: ['GET'])]
    public function getMoyenneL1(): JsonResponse
    {
        $semestreL1 = $this->getSemestersForYear(1);
        $students = $this->etudiantRepository->getStudentsWithMoyenneAndNotesL1($semestreL1);
        usort($students, function ($a, $b) {
            return $b['moyenne'] <=> $a['moyenne'];
        });
        foreach ($students as $key => &$student) {
            $student['rang'] = $key + 1;
            $student['resultat'] = $student['moyenne'] >= 10 ? 'Admis' : 'Non Admis';
        }
        return JsonHelper::success($students, 'Liste des étudiants');
    }


    #[Route('/api/notes', name: 'get_notes', methods: ['GET'])]
    public function getNotes(Request $request): JsonResponse
    {
        $identifiant = $request->query->get('etu');
        $year = $request->query->get('annee');
        if (!$identifiant || !$year) {
            return JsonHelper::createErrorResponse('Identifiant and year are required.', 400);
        }
        $etudiant = $this->etudiantRepository->findByIdentifiant('ETU' . $identifiant);
        if (!$etudiant) {
            return JsonHelper::createErrorResponse('Student not found.', 404);
        }
        $semesters = $this->getSemestersForYear($year);
        if (!$semesters) {
            return JsonHelper::createErrorResponse('Invalid year provided.', 400);
        }
        $notes = $this->noteRepository->findNotesByStudentAndSemesters($etudiant, $semesters);
        if (!$notes) {
            return JsonHelper::createErrorResponse('No notes found for the student.', 404);
        }
        $responseData = [
            'student' => [
                'nom' => $etudiant->getNom(),
                'prenom' => $etudiant->getPrenom(),
                'identifiant' => $etudiant->getIdentifiant(),
                'annee' => $year
            ],
            'notes' => []
        ];
        foreach ($notes as $note) {
            $matiere = $note->getMatiere();
            $session = $note->getSession();
            $semestre = $matiere->getSemestre();

            $responseData['notes'][] = [
                'matiere' => [
                    'code' => $matiere->getCode(),
                    'nom' => $matiere->getNom(),
                    'credit' => $matiere->getCredit()
                ],
                'valeur' => $note->getValeur(),
                'session' => $session ? $session->format('Y-m-d') : null,
                'semestre' => $semestre ? $semestre->getNom() : null
            ];
        }
        return JsonHelper::success($responseData);
    }
    private function getSemestersForYear(int $year): array
    {
        switch ($year) {
            case 1:
                return [1, 2];
            case 2:
                return [3, 4];
            default:
                return [];
        }
    }
}
