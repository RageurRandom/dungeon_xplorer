<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'autoload.php';

class Router
{
    private $routes = [];
    private $prefix;

    public function __construct($prefix = '')
    {
        $this->prefix = trim($prefix, '/');
    }

    public function addRoute($uri, $controllerMethod)
    {
        $this->routes[trim($uri, '/')] = $controllerMethod;
    }

    public function route($url){
        // Enlève le préfixe du début de l'URL
        if ($this->prefix && strpos($url, $this->prefix) === 0) {
            $url = substr($url, strlen($this->prefix) + 1);
        }

        // Enlève les barres obliques en trop
        $url = trim($url, '/');

        // Vérification de la correspondance de l'URL à une route définie
        foreach ($this->routes as $route => $controllerMethod) {
            // Vérifie si l'URL correspond à une route avec des paramètres
            $routeParts = explode('/', $route);
            $urlParts = explode('/', $url);

            // Si le nombre de segments correspond
            if (count($routeParts) === count($urlParts)) { 
                // Vérification de chaque segment
                $params = [];
                $isMatch = true;
                foreach ($routeParts as $index => $part) { 
                    if (preg_match('/^{\w+}$/', $part)) {
                        // Capture les paramètres
                        $params[] = $urlParts[$index]; 
                    } elseif ($part !== $urlParts[$index]) {
                        $isMatch = false;
                        break;
                    }
                } 
                if ($isMatch) {
                    // Extraction du nom du contrôleur et de la méthode
                    list($controllerName, $methodName) = explode('@', $controllerMethod);

                    // Instanciation du contrôleur et appel de la méthode avec les paramètres
                    $controller = new $controllerName();
                    call_user_func_array([$controller, $methodName], $params);
                    return;
                }
            }
        }

        // Si aucune route n'a été trouvée, gérer l'erreur 404
        require_once 'views/accueil/accueilNonConnecter.php';
    }
}

// Instanciation du routeur
$router = new Router('dx_11');

// Ajout des routes
$router->addRoute('', 'AccueilController@index'); // Pour l'accueil

$router->addRoute('connexion', 'ConnexionController@connect');// Pour la connection
$router->addRoute('deconnexion', 'ConnexionController@logoff');//Pour la déconnexion
$router->addRoute('creationCompte', 'ConnexionController@create');//Pour la création de compte

$router->addRoute('creationHero', 'PersonnageController@createHero'); // Pour créer le personnage
$router->addRoute('recuperationHero', 'PersonnageController@getHero'); // Pour récupérer le personnage
$router->addRoute('reinitialisationHero', 'PersonnageController@resetHero'); // Pour réinitialiser le personnage


$router->addRoute('chapitre', 'ChapitreController@showChapter'); // Pour afficher le chapitre en cours
$router->addRoute('chapitreSuivant/{numChap}/{tresor}/{monstreID}/{itemID}/{spellID}', 'ChapitreController@nextChapter'); //Pour passer d'un chapitre à l'autre

$router->addRoute('profile', 'ProfileController@index'); // Pour le profile
$router->addRoute('combat', 'CombatController@index'); 

// Appel de la méthode route
$router->route(trim($_SERVER['REQUEST_URI'], '/'));
?>