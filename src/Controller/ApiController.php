<?php

namespace App\Controller;

use App\Entity\Continent;
use App\Entity\Pays;
use App\Entity\Temperature;
use App\Entity\TypeVoyage;
use App\Entity\Ville;
use App\Repository\ContinentRepository;
use App\Repository\PaysRepository;
use App\Repository\TemperatureRepository;
use App\Repository\TypeVoyageRepository;
use App\Repository\VilleRepository;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Stmt\Return_;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class ApiController {

    /**
     * @Route("/ville", name="ville")
    */
    public function getAllVille(VilleRepository $repository) {
        $villes = $repository->findAll();
        return $this->setDataVille($villes);
    }

    /**
     * @Route("/continent", name="continent")
     */
    public function getAllContinent(ContinentRepository $repository) {
        $continents = $repository->findAll();
        return $this->setDataContinent($continents);
    }

    /**
     * @Route("/pays", name="pays")
     */
    public function getAllPays(PaysRepository $repository) {
        $pays = $repository->findAll();
        return $this->setDataPays($pays);
    }

    /**
     * @Route("/temperature", name="temperature")
     */
    public function getAllTemperature(TemperatureRepository $repository) {
        $temperatures = $repository->findAll();
        return $this->setDataTemperature($temperatures);
    }

    /**
     * @Route("/type", name="type")
     */
    public function getAllType(TypeVoyageRepository $repository) {
        $types = $repository->findAll();
        return $this->setDataType($types);
    }

    /***************************************************************************************************/

    /**
     * @Route("/nomVille", name="nomVille", methods={"POST"})
     */
    public function getVilleByName(VilleRepository $repository, Request $request) {
        $data = $request->getContent();
        $villes = $repository->findByName($data);
        return $this->setDataVille($villes);
    }

    /**
     * @Route("/typeVille", name="typeVille", methods={"POST"})
     */
    public function getVilleByType(VilleRepository $repository, Request $request) {
       $data = json_decode($request->getContent(),true);
       $villes = $repository->findByType($data['nom_type']);
       return $this->setDataVille($villes);
    }

    /**
     * @Route("/paysByContinent", name="paysByContinent", methods={"POST"})
     */
    public function getPaysByContinent(PaysRepository $repository, Request $request) {
        $data = json_decode($request->getContent(), true);
        $pays = $repository->findByContinent($data['nom_continent']);
        return $this->setDataPays($pays);
    }

    /**
     * @Route("/search", name="search", methods={"POST"})
     */
    public function search(VilleRepository $repository, Request $request) {
        $data = json_decode($request->getContent(), true);
        $villes = $repository->findByCriteria($data['degre'], $data['mois'], $data['nom_pays'], $data['nom_type']);
        $response = new Response(json_encode($villes), 200, [
            'Content-Type' => 'application/json'
        ]);
        return $response;
    }
/**************** SET DATA ***********************/
    public function setDataVille($villes) {
        $result = array();
        foreach($villes as $ville){
            $types = array();
            $objet['nom_ville'] = $ville->getNomVille();
            $objet['budget'] = $ville->getBudget();
            foreach($ville->getType() as $type){
                array_push($types, $type->getNomType());
            }
            $objet['type'] = $types;
            $objet['pays'] = $ville->getPays()->getNomPays();
            array_push($result, $objet);
        }
        $response = new Response(json_encode($result));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function setDataContinent($continents) {
        $result = array();
        foreach($continents as $continent){
            $paysTab = array();
            $objet['nom_continent'] = $continent->getNomContinent();
            foreach($continent->getPays() as $pays){
                array_push($paysTab, $pays->getNomPays());
            }
            $objet['pays'] = $paysTab;
            array_push($result, $objet);
        }
        $response = new Response(json_encode($result));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function setDataType($types) {
        $result = array();
        foreach($types as $type){
            array_push($result, $type->getNomType());
        }
        $response = new Response(json_encode($result));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function setDataPays($paysTab) {
        $result = array();
        foreach($paysTab as $pays){
            array_push($result,  $pays->getNomPays());
        }
        $response = new Response(json_encode($result));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function setDataTemperature($temperatures) {
        $result = array();
        foreach($temperatures as $temperature){
            $objet['degre'] = $temperature->getDegre();
            $objet['mois'] = $temperature->getMois();
            $objet['ville'] = $temperature->getVille()->getNomVille();
            array_push($result, $objet);
        }
        $response = new Response(json_encode($result));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}

