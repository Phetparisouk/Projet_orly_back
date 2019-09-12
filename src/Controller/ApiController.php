<?php

namespace App\Controller;

use App\Entity\Continent;
use App\Entity\Pays;
use App\Entity\Temperature;
use App\Entity\TypeVoyage;
use App\Entity\Ville;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Stmt\Return_;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class ApiController {

    /**
     * @Route("/ville", name="ville_app")
    */
    public function getAllVille(EntityManagerInterface $em) {
        $repo = $em->getRepository(Ville::class);
        $villes = $repo->findAll();
        return $this->setDataVille($villes);
    }

    /**
     * @Route("/continent", name="continent")
     */
    public function getAllContinent(EntityManagerInterface $em) {
        $repo = $em->getRepository(Continent::class);
        $continents = $repo->findAll();
        return $this->setDataContinent($continents);
    }

    /**
     * @Route("/pays", name="pays")
     */
    public function getAllPays(EntityManagerInterface $em) {
        $repo = $em->getRepository(Pays::class);
        $pays = $repo->findAll();
        return $this->setDataPays($pays);
    }
    /**
     * @Route("/temperature", name="temperature")
     */
    public function getAllTemperature(EntityManagerInterface $em) {
        $repo = $em->getRepository(Temperature::class);
        $temperatures = $repo->findAll();
        return $this->setDataTemperature($temperatures);
    }
    /**
     * @Route("/nomVille", name="nomVille", methods={"POST"})
     */
    public function getVilleByName(EntityManagerInterface $em, Request $request) {
        $data = $request->getContent();
        $repo = $em->getRepository(Ville::class);
        $villes = $repo->findByName($data);
        return $this->setDataVille($villes);
    }

//    /**
//     * @Route("/typeVille", name="typeVille", methods={"POST"})
//     */
   /* public function getVilleByType(EntityManagerInterface $em, Request $request) {
        $data = json_decode($request->getContent(), true);
        $repo = $em->getRepository(Ville::class);
        $repoType = $em->getRepository(TypeVoyage::class);

        $crit['nom_type'] = $data['type'];
        $type['type'] = $repoType->findBy($crit)[0]->getId();
        //dump($type);
        $villes = $repo->findBy($type);

        //return new Response();
        return $this->setDataVille($villes);
    }*/

    /**
     * @Route("/paysByContinent", name="paysByContinent", methods={"POST"})
     */
    public function getpaysByContinent(EntityManagerInterface $em, Request $request) {
        $data = json_decode($request->getContent(), true);
        $repo = $em->getRepository(Pays::class);
        $pays = $repo->findBy($data);
        return $this->setDataPays($pays);
    }

    /**
     * @Route("/search", name="search", methods={"POST"})
     */
    public function getPaysByContinant(EntityManagerInterface $em, Request $request) {
        $data = json_decode($request->getContent(), true);
        $repo = $em->getRepository(Ville::class);
        $pays = $repo->findByCriteria($data);
        return $this->setDataVille($pays);
    }

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
    public function setDataPays($paysTab) {
        $result = array();
        foreach($paysTab as $pays){
            $objet['nom_pays'] = $pays->getNomPays();
            $objet['code'] = $pays->getCode();
            $villes = array();
            foreach($pays->getVilles() as $ville){
                array_push($villes, $ville->getNomVille());
            }
            $objet['villes'] = $villes;
            $objet['continents'] = $pays->getContinent()->getNomContinent();
            array_push($result, $objet);
        }

        $response = new Response(json_encode($result));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function setDataTemperature($temperatures) {
        $result = array();
        foreach($temperatures as $temperature){
            $types = array();
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

