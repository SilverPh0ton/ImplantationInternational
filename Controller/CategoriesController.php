<?php

namespace App\Controller;

use App\Model\Entity\Categorie;
use CategoriesDB;
require_once 'DBObjects/CategoriesDB.php';
require_once 'Controller/AppController.php';
require_once 'Entity/Categorie.php';

class CategoriesController extends AppController
{
    private $categoriesDB;
    public function __construct()
    {
        $this->categoriesDB = new CategoriesDB();
    }

    public function add()
    {
        $this->isAuthorized(['admin']);

        //Gère la réponse de la vue
        if (!empty($_POST)) {

            $categorieExiste = $this->categoriesDB->categorieExist($_POST['categorie']);

            if ($categorieExiste) {
                $this->flashBad('Cette catégorie existe déjà');
                return $this->redirect("Categories", 'Add');
            }


            $category = new Categorie(
                null,
                1,
                $_POST['categorie']
            );

            //Enregistre l’entité
            if ($this->categoriesDB->addCategorie($category)) {
                $this->flashGood('La catégorie a été enregistrée.');

                //Redirige à la page appropriée
                return $this->redirect('Configuration','index');
            }
            $this->flashBad('La catégorie n\'a pas pu être enregistrée. Veuillez réessayer.');
            return $this->redirect('Configuration',  'index');
        }
    }


    public function edit($id = null)
    {
        $this->isAuthorized(['admin']);

        //Requêtes au serveur SQL
        $categorie = $this->categoriesDB->getCategorieFromId($id);

        //Passe les variables à la vue
        $this->set('categorie', $categorie);

        //Gère la réponse de la vue
        if (!empty($_POST)) {


                if (isset($_POST['actif'])) {
                    $actif = 1;
                } else {
                    $actif = 0;
                }

                $category = new Categorie(
                    $id,
                    $actif,
                    $_POST['categorie']
                );

                //Enregistre l’entité
                if ($this->categoriesDB->updateCategorie($category)) {
                    $this->flashGood('La catégorie a été modifiée.');

                    //Redirige à la page appropriée
                    return $this->redirect('Configuration', 'index');
                }
                $this->flashBad('La catégorie n\'a pas pu être modifiée. Veuillez réessayer.');
                return $this->redirect('Configuration',  'index');
        }
    }
}
