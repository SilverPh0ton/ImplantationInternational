<?php


use App\Model\Entity\Categorie;
include_once 'DBObjects/ConfigDB.php';
require_once 'Entity/Destination.php';
require_once 'Entity/Categorie.php';


class CategoriesDB extends ConfigDB
{
    /**
     * CategoriesDB constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    public function getCategorieFromId($id_categorie)
    {
        if(isset($id_categorie))
        {
            $sql = "SELECT * FROM categories WHERE id_categorie = :id_categorie";

            if ($stmt = $this->conn->prepare($sql)) {

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":id_categorie", $id_categorie , PDO::PARAM_INT);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Check if username exists, if yes then verify password
                    if ($stmt->rowCount() == 1) {

                        if ($row = $stmt->fetch()) {
                            $categorie = new Categorie(
                                $row['id_categorie'],
                                $row['actif'],
                                $row['categorie']
                            );

                            return $categorie;

                        }
                        else
                        {
                            return null;
                        }

                    }
                    else
                    {
                        return null;
                    }

                }
                else
                {
                    return null;
                }

                // Close statement
                unset($stmt);

            }
            else
            {
                return null;
            }
        }
        else
        {
            return null;
        }
    }

    public function getAllCategories()
    {
        $categories = array();
        $sql = "SELECT * from categories ORDER BY actif DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $categoriesInfo = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach($categoriesInfo as $categorieInfo)
        {
            $categorie = new Categorie(
                $categorieInfo['id_categorie'],
                $categorieInfo['actif'],
                $categorieInfo['categorie']
            );


            array_push($categories, $categorie);
        }

        return $categories;
    }

    public function getAllActifCategories()
    {
        $categories = array();
        $sql = "SELECT * from categories WHERE actif = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $categoriesInfo = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach($categoriesInfo as $categorieInfo)
        {
            $categorie = new Categorie(
                $categorieInfo['id_categorie'],
                $categorieInfo['actif'],
                $categorieInfo['categorie']
            );


            array_push($categories, $categorie);
        }

        return $categories;
    }

    public function addCategorie(Categorie $categorie)
    {
        if (isset($categorie))
        {
            $stmtExist = $this->conn->prepare("SELECT count(*) from categories where categorie = :categorie");
            $stmtExist->execute(array(':categorie' => $categorie->getCategorie()));
            $categorieCtr = $stmtExist->fetchColumn();

            if ($categorieCtr == 0) {
                $sql = "INSERT INTO categories (categorie,actif) VALUES(:categorie, :actif)";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute(array(':categorie' => $categorie->getCategorie(),
                    ':actif' => $categorie->getActif()
                ));

                return true;
            } else {
                $sql = "UPDATE categories SET actif = 1 WHERE categorie = :categorie";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute(array(':categorie' => $categorie->getCategorie()));
                return true;
            }
        } else {
            return false;
        }
    }

    function updateCategorie($category)
    {
        if (isset($category))
        {
            $stmtExist = $this->conn->prepare("SELECT count(*) from categories where id_categorie = :id_categorie");
            $stmtExist->execute(array(':id_categorie' => $category->getIdCategorie()));
            $compteCtr = $stmtExist->fetchColumn();

            if ($compteCtr == 1) {
                $sql = "UPDATE categories SET 
                categorie = :categorie,
                actif = :actif
                WHERE id_categorie = :id_categorie ";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute(array(
                    ':categorie' => $category->getCategorie(),
                    ':actif' => $category->getActif(),
                    ':id_categorie'=> $category->getIdCategorie()));

                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function setCategorieActif(Categorie $categorie)
    {
        if (isset($categorie)&&$categorie->validate())
        {
            $stmtExist = $this->conn->prepare("SELECT count(*) from categories where categorie = :categorie");
            $stmtExist->execute(array(':categorie' => $categorie->getCategorie()));
            $categorieCtr = $stmtExist->fetchColumn();

            if ($categorieCtr == 1) {
                $sql = "UPDATE categories SET actif = 1 WHERE categorie = :categorie";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute(array(':categorie' => $categorie->getCategorie()));
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function setCategorieInactif(Categorie $categorie)
    {
        if (isset($categorie)&&$categorie->validate())
        {
            $stmtExist = $this->conn->prepare("SELECT count(*) from categories where categorie = :categorie");
            $stmtExist->execute(array(':categorie' => $categorie->getCategorie()));
            $categorieCtr = $stmtExist->fetchColumn();

            if ($categorieCtr == 1) {
                $sql = "UPDATE categories SET actif = 0 WHERE categorie = :categorie";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute(array(':categorie' => $categorie->getCategorie()));
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function categorieExist($categorie)
    {
        if (isset($categorie))
        {
            $stmtExist = $this->conn->prepare("SELECT count(*) from categories where categorie = :categorie");
            $stmtExist->execute(array(':categorie' => $categorie));
            $categorieCtr = $stmtExist->fetchColumn();

            if ($categorieCtr == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return null;
        }
    }

}