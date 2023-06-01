<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" media="screen">

</head>

<body>
    <div class="container">
        <?php

        /**
         * Exemple d'utilisation de la classe Form pour la création d'un formulaire
         */

        require 'Form.php';
        require 'FormElement.php';
        require 'FormInput.php';
        require 'FormSelect.php';
        require 'FormTextarea.php';

        // Debug
        echo '$_POST : ';
        var_dump($_POST);
        echo '<br>';
        echo '$_GET : ';
        var_dump($_GET);


        $form = new FORMidable\Form(); // Instanciation du formulaire

        $form->setMethod('POST') // Définition des paramêtres de base du formulaire
            ->setAction("")
            ->setName("megaform");

        $form->fieldset("Le formulaire"); // Ajout d'une balise <fieldset>

        $form->nest('<div class="form-group">'); // Ajout d'une balise de nesting personnalisé

        /**
         * Ajout d'une balise orpheline <input> définie à l'aide de 2 paramètres :
         * 1 - Un tableau associatif comportant tout les attributs souhaités
         * 2 - Option : Le nom souhaité (string) pour une balise <label> associée à l'input
         */
        $form->addInput(["type" => "hidden", "id" => "id", "value" => uniqid()]);

        $form->addInput(["type" => 'file', "name" => "img", "accept" => ".png", "multiple" => true, "class" => "form-control"], "Votre photo");

        $form->addInput(["type" => 'date', "name" => "date", "value" => date("Y-m-d"), "class" => "form-control"], "Date du jour");

        $form->addInput(["type" => 'number', "name" => "nombre", "id" => "number", "class" => "form-control", "placeholder" => "Un nombre en 8 et 12"], "Des nombres");

        $form->addInput(["type" => "password", 'id' => 'password', 'name' => 'password', "class" => "form-control"], "Mot de passe")
            ->htmlAfter('<small>Ceci est une insertion after</small>');

        $form->addInput(["type" => "email", "id" => 'email', "name" => "email", "placeholder" => "votre mail", "class" => "form-control", "required" => '', "autocomplete" => "off"], "votre mail");

        $form->addInput(["type" => "checkbox", "id" => "lkjfdk", "name" => "check"], "check")->labelAfter();

        /**
         * Ajout d'une balise inline <select> définie à l'aide de 2 paramètres :
         * 1 - Un tableau associatif comportant tout les attributs souhaités
         * 2 - Le nom souhaité (string) pour la balise <label> associé à la liste
         * 
         * Pour ajouter des <option> on invoque la function setOptions()
         * 3 - Les <option> de la liste sous la forme d'un tableau de tableaux
         *     Note : Chaque option est un tableau de 2 à 3 valeurs ['name','value','selected']
         */
        $options = [];
        $options[] = ['youki', 'dog'];
        $options[] = ['minimne', 'cat', 1];
        $options[] = ['baloo', 'bear'];
        $options[] = ['Tintin'];
        $form->addSelect(["name" => "pets", "id" => "pet-select"])
            ->setOptions($options)
            ->setAttribute("size", count($options)); //*, "Choisi ton animal", $options




        /**
         * Ajout d'une balise inline <textarea> définie à l'aide de 2 paramètres :
         * 1 - Un tableau associatif comportant tout les attributs souhaités
         * 2 - Option : Le nom souhaité (string) pour une balise <label> associée à la liste
         */
        $form->addTextarea(["id" => "😚", "name" => "bio", "value" => "C'est ici que vous saisirez votre biographie", "rows" => 6, "class" => "form-control"], "Bio");

        $form->addInput(["type" => "submit", "value" => "😍😘😚 envoyer", "class" => "btn btn-success"]);

        $form->render(); // Appel de la méthode render pour afficher le formulaire
