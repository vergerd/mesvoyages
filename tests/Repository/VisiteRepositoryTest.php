<?php


namespace App\Tests\Repository;

use App\Entity\Visite;
use App\Repository\VisiteRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Description of VisiteRepositoryTest
 *
 * @author Damien
 */
class VisiteRepositoryTest extends KernelTestCase {
    const VILLE = "New York";
    const PAYS = "USA";
    /**
     * Création d'une instance de Visite avec ville, pays et dateCreation
     * @return Visite
     */
    public function newVisite(): Visite{
        $visite = (new Visite())
                ->setVille(self::VILLE)
                ->setPays(self::PAYS)
                ->setDatecreation(new DateTime("now"));
        return $visite;
    }
    /**
     * Récupère le repository de Visite
     * @return VisiteRepository
     */
    public function recupRepository() {
        self::bootKernel();
        $repository = self::getContainer()->get(VisiteRepository::class);
        return $repository;
    }
    public function testNbVisites(){
        $repository = $this->recupRepository();
        $nbVisites = $repository->count([]);
        $this->assertEquals(2, $nbVisites);
    }
    public function testAddVisite(){
        $repository = $this->recupRepository();
        $visite = $this->newVisite();
        $nbVisites = $repository->count([]);
        $repository->add($visite, true);
        $this->assertEquals($nbVisites + 1, $repository->count([]), "erreur lors de l'ajout");
    }
    public function testRemoveVisite(){
        $repository = $this->recupRepository();
        $visite = $this->newVisite();
        $repository->add($visite, true);
        $nbVisites = $repository->count([]);
        $repository->remove($visite, true);
        $this->assertEquals($nbVisites - 1, $repository->count([]), "erreur lors de la suppression");
    }
    public function testFindByEqualValue(){
        $repository = $this->recupRepository();
        $visite = $this->newVisite();
        $repository->add($visite, true);
        $visites = $repository->findByEqualValue("ville", self::VILLE);
        $nbVisites =  count($visites);
        $this->assertEquals(1, $nbVisites);
        $this->assertEquals(self::VILLE, $visites[0]->getVille());
    }
}

