<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use App\Entity\Program;


#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{



    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        return $this->render('program/index.html.twig', [
            'website' => 'Wild Series',
            'programs' => $programs,
        ]);
    }

    /*
    #[Route('/list/{page}', requirements: ['page'=>'\d+'], name: 'list')]

    public function list(int $page = 1): Response
    {
        return $this->render('program/list.html.twig', [
            'page' => $page
        ]);
    }
    */

    #[Route('/show/{id}', methods: ['GET'], requirements: ['id' => '\d+'], name: 'show')]
    public function show(ProgramRepository $programRepository, int $id = 1): Response
    {
        $program = $programRepository->findOneBy(['id' => $id]);
        $seasons = $program->getSeasons();

        return $this->render('program/show.html.twig', [
            'id' => $id,
            'program' => $program,
            'seasons' => $seasons,
        ]);
    }

    #[Route('/{programId}/season/{seasonId}', methods: ['GET'], requirements: ['programId' => '\d+', 'seasonId' => '\d+'], name: 'season_show')]
    public function showSeason(ProgramRepository $programRepository, SeasonRepository $seasonRepository, int $programId, int $seasonId): Response
    {
        $program = $programRepository->findOneById($programId);
        $season = $seasonRepository->findOneById($seasonId);
        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'season' => $season
        ]);
    }
}
