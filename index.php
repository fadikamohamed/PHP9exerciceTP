<?php
//Tableau des jours de la semaine
$daysOfWeekArray = array(
    1 => 'Lun.',
    2 => 'Mar.',
    3 => 'Mer.',
    4 => 'Jeu.',
    5 => 'Ven.',
    6 => 'Sam.',
    7 => 'Dim.'
);
//Tableau des mois de l'année
$monthsOfYearArray = array(
    1 => 'Janvier',
    2 => 'Février',
    3 => 'Mars',
    4 => 'Avril',
    5 => 'Mai',
    6 => 'Juin',
    7 => 'Juillet',
    8 => 'Août',
    9 => 'Septembre',
    10 => 'Octobre',
    11 => 'Novembre',
    12 => 'Décembre'
);
$month = 0;
$year = 0;
//Si les valeurs du formulaire sont dans les superglobales $_POST...
if (!empty($_POST['month']) && !empty($_POST['year'])) {
    //Intégration des valeurs des superglobales dans les variables $month et $year
    $month = $_POST['month'];
    $year = $_POST['year'];
    //Calcul du nombre de jours dans un mois
    $daysInMonth = date('t', mktime(0, 0, 0, $month, 1, $year));
    //Calcul du jour de la semaine en numérique
    $dayOfWeek = date('N', mktime(0, 0, 0, $month, 1, $year));
    //Définition du numéro du jour
    $numberOfDay = 1;
    //Définition du numéro de la case
    $dayInCase = 0;
    //La variable contenant le numéro de la case est égale au nombre de jours dans le mois plus le numéro du jour de la semaine mois un
    $numberOfCase = $daysInMonth + $dayOfWeek - 1;
    //Le nombre de ligne maximum est égale a 5 si la variable $numberOfCase est inférieur ou égale a 35 sinon il est égale a 6
    $lineMax = $numberOfCase <= 35 ? 5 : 6;
    //Sinon...
} else {
} ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
        <title>TP</title>
    </head>
    <body>
        <div class="container">
            <div class="justify-content-center">
                <h1 class="text-center">Calendrier</h1>
                <!--------------------------------------------------------------------------------------------------------------------------------->
                <!--Début du formulaire de selection du mois et de l'année--> 
                <form class="bg-secondary rounded p-2" action= "#" method="POST">
                    <!-- Menu déroulant pour le mois -->
                    <label for="month">Mois : </label>
                    <select name="month">
                    <?php
                        //Affichage des mois en boucle dans le menu déroulant 
                        foreach ($monthsOfYearArray as $number => $months) { ?>
                            <!-- L'option envoie le numéro du mois -->
                            <option value="<?= $number ?>"<?=
                            //Si la variable $month n'est pas égale a zero et que son contenu est égal a la variable $number, ajouter l'option selected a la balise option sinon null
                            (($month != 0) && ($month == $number)) ? 'selected = "selected"' : NULL;
                            ?>><?= $months ?></option><?php } ?>
                    </select>
                    <!-- Menu déroulant pour l'année -->
                    <label for="year">Années : </label>
                    <select name="year">
                        <?php
                        //Affichage des années en boucle de 1960 a 2060
                        for ($years = 1960; $years < 2060; $years++) { ?>
                            <!-- L'option envoie l'année -->
                            <option value="<?= $years ?>"<?=
                            //Si la variable $year n'est pas egalz a zero et que son contenu est égale a la variable $year, ajouter l'option selected a la balise option sinon null
                            (($year != 0) && ($year == $years)) ? 'selected = "selected"' : NULL; ?>><?= $years ?></option>
                        <?php } ?>
                    </select>
                    <!-- Bouton envoyer -->
                    <input type="submit" name="submit" value="Afficher" />
                <p>Veuillez choisir un mois et une année.</p>
                </form>
                <!--------------------------------------------------------------------------------------------------------------------------------->
                <!--Div du calendrier-->
                <div class="row calandar justify-content-center">
                    <!--Début du calendrier-->
                    <table class="table table-bordered table-striped text-center">
                        <!-- En tête du tableau -->
                        <thead class="thead-dark rounded-top">
                            <?php
                            //Affichage des jours de la semaine en boucle de Lundi a Dimanche a partir du tableau
                            foreach ($daysOfWeekArray as $day) { ?>
                            <th><?= $day ?></th>
                        <?php } ?>
                        </thead>
                        <!-- Cases du tableau -->
                        <tbody class="table table-sm table-hover">
                            <?php
                            //Si les variables $month et $year ne sont pas vide
                            if (($month != 0) && ($year != 0)) {
                                //Déclaration de la boucle qui génere les lignes du tableau (semaines) 
                                for ($line = 0; $line < $lineMax; $line++) { ?>
                                    <tr>
                                        <?php
                                        //Déclaration de la boucle qui génere les colonnes du tableau (jours)
                                        for ($day = 0; $day < 7; $day++) { ?>
                                            <td<?php
                                            //Si numéro de la case ($numberOfDay) est supérieur ou égale au jour de la semaine et que le jour du mois est inférieur ou égale au nombre de jours dans le mois
                                            if ((($dayInCase) >= ($dayOfWeek - 1)) && ($numberOfDay <= $daysInMonth)) { ?> 
                                                    class="table-light">
                                                    <?php
                                                    //Afficher le numéro du jour
                                                    echo $numberOfDay;
                                                    //Incrémenter le numéro du jour de 1
                                                    $numberOfDay++;
                                                    //Incrementer le numéro de la case de 1
                                                    $dayInCase++;
                                                    //Sinon
                                                } else { ?>
                                                    class="table-secondary">
                                                    <?php
                                                    //Incrementer le numéro de la case de 1
                                                    $dayInCase++;
                                                } ?></td>
                                            <?php
                                        }
                                    }
                                } else { 
                                    //Affichage des cases vides en boucle
                                    for ($i = 0; $i < 7; $i++) { ?>
                                        <td> </td>
                                    <?php } } ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js" charset="utf-8"></script>
    </body>
</html>
