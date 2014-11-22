<?php
namespace Core\Routing;

use ArrayAccess;
use Iterator;
use Countable;

class Router implements ArrayAccess, Iterator, Countable
{
	/**
	 * Curseur de lecture du tableau
	 *
	 * @var integer
	 */
	private $handler = 0;

	/**
	 * Tableau des routes
	 *
	 * @var array
	 */
	private $routes = array();

	/**
	 * Tableau des actions pour un 
	 * controller de ressources
	 *
	 * @var array
	 */
	private $ressourceAction = array('lists', 'show', 'add', 'update', 'delete');

	/**
	 * Crée une instance du Router
	 *
	 * @param array $routes
	 * @return void
	 */
	public function __construct($routes = array())
	{
		$this->buildRoute($routes);
	}

	/**
	 * Crée pour chaque route un objet
	 * Route
	 *
	 * @param array $routes
	 * @return array
	 */
	private function buildRoute($routes) {
		foreach	($routes as $route) {
			if (isset($route['options']) && $route['options']['ressource'] == 'yes') {
				$this->buildRessourceRoute($route);
			} else {
				$this[] = new Route($route);
			}
		}
	}

	/**
	 * Construit les routes nécessaire
	 * pour un controller de ressource
	 *
	 * @param array $route
	 * @return void
	 */
	private function buildRessourceRoute($route)
	{
		if (!isset($route['options']['where'])) {
			$where = array(
				'param'=>'id',
				'type'=>'integer'
			);
		} else {
			$where = $route['options']['where'];
		}

		foreach ($this->ressourceAction as $action) {
			$tabRoute = $this->{$action.'Ressource'}($route['url'], $route['controller'], $action, $where);
			$this[]	= new Route($tabRoute);
		}
	}

	/**
	 * Construit le tableau pour créer la route
	 * listant les ressources
	 *
	 * @param string $label
	 * @param string $controller
	 * @param string $action
	 * @param array  $where
	 * @return array
	 */
	private function listsRessource($label, $controller, $action, $where = null)
	{
		return array(
			'url' => $label,
			'controller' => $controller,
			'action' => $action, 
			'method' => 'GET'
		);
	}

	/**
	 * Construit le tableau pour créer la route
	 * ajoutant une ressource
	 *
	 * @param string $label
	 * @param string $controller
	 * @param string $action
	 * @param array  $where
	 * @return array
	 */
	private function addRessource($label, $controller, $action, $where = null)
	{
		return array(
			'url' => $label,
			'controller' => $controller,
			'action' => $action, 
			'method' => 'POST'
		);
	}

	/**
	 * Construit le tableau pour créer la route
	 * affichant une ressource
	 *
	 * @param string $label
	 * @param string $controller
	 * @param string $action
	 * @param array  $where
	 * @return array
	 */
	private function showRessource($label, $controller, $action, $where)
	{
		return array(
			'url' => $label.'/{'.$where['param'].'}',
			'where' => array(
				$where['param'] => $where['type']
			),
			'controller' => $controller,
			'action' => $action, 
			'method' => 'GET'
		);
	}

	/**
	 * Construit le tableau pour créer la route
	 * modifiant une ressource
	 *
	 * @param string $label
	 * @param string $controller
	 * @param string $action
	 * @param array  $where
	 * @return array
	 */
	private function updateRessource($label, $controller, $action, $where)
	{
		return array(
			'url' => $label.'/{'.$where['param'].'}',
			'where' => array(
				$where['param'] => $where['type']
			),
			'controller' => $controller,
			'action' => $action, 
			'method' => 'PUT'
		);
	}

	/**
	 * Construit le tableau pour créer la route
	 * supprimant une ressource
	 *
	 * @param string $label
	 * @param string $controller
	 * @param string $action
	 * @param array  $where
	 * @return array
	 */
	private function deleteRessource($label, $controller, $action, $where)
	{
		return array(
			'url' => $label.'/{'.$where['param'].'}',
			'where' => array(
				$where['param'] => $where['type']
			),
			'controller' => $controller,
			'action' => $action, 
			'method' => 'DELETE'
		);
	}

	/**
	 * Retourne la valeur de la clé
	 * correspondante
	 *
	 * @param  string $key
	 * @return mixed 
	 */
	private function get($key)
	{
		return $this->routes[$key];
	}

	/**
	 * Assigne une valeur 
	 *
	 * @param  string $key
	 * @param  mixed  $value
	 * @return void
	 */
	private function set($key, $value)
	{
		if (is_null($key)) {
			$key = count($this);
		}
		$this->routes[$key]	= $value;
	}

	/*
	 * Retourne la valeur de la clé
	 * correpondante
	 *
	 * @param  string $key
	 * @return mixed
	 */
	public function offsetGet($key)
	{
		return $this->get($key);
	}

	/**
	 * Assigne une valeur 
	 *
	 * @param  string $key
	 * @param  mixed  $value
	 * @return void
	 */
	public function offsetSet($key, $value)
	{
		return $this->set($key,$value);
	}

	/**
	 * Vérifie si la clé existe
	 *
	 * @param  string $key
	 * @return boolean 
	 */
	public function offsetExists($key)
	{
		return isset($this->routes[$key]);
	}
	
	/**
	 * Supprime une entrée
	 *
	 * @param  string $key
	 * @return boolean 
	 */
	public function offsetUnset($key)
	{
		unset($this->routes[$key]);
	}

	/**
	 * Retourne l'élément courant du
	 * tableau
	 *
	 * @return mixed
	 */
	public function current()
	{
		return $this->routes[$this->handler];
	}

	/**
	 * Retourne la clé actuelle
	 * (c'est la position)
	 *
	 * @return integer
	 */
	public function key()
	{
		return $this->handler;	
	}

	/**
	 * Déplace le curseur vers
	 * l'élement suivant
	 *
	 * @return void
	 */
	public function next()
	{
		$this->handler++;	
	}

	/**
	 * Remet la position du
	 * curseur à 0
	 *
	 * @return void
	 */
	public function rewind()
	{
		$this->handler = 0;	
	}

	/**
	 * Vérfie l'existence de la position
	 * du curseur
	 *
	 * @return boolean
	 */
	public function valid()
	{
		return isset($this->routes[$this->handler]);
	}

	/**
	 * Retourne le nombre d'élement
	 * du tableau
	 *
	 * @return integer
	 */
	public function count()
	{
		return count($this->routes);
	}
}
