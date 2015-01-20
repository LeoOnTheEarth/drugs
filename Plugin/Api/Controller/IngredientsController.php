<?php

App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');

class IngredientsController extends ApiAppController {

    public $name = 'Ingredients';
    public $uses = array('Ingredient');
    public $paginate = array();
    public $helpers = array();

    public function index($name = null) {
        $scope = array();
        if (!empty($name)) {
            $name = Sanitize::clean($name);
            $keywords = explode(' ', $name);
            $keywordCount = 0;
            foreach ($keywords AS $keyword) {
                if (++$keywordCount < 5) {
                    $scope[]['OR'] = array(
                        'Ingredient.name LIKE' => "%{$keyword}%",
                    );
                }
            }
        }
        $this->paginate['Ingredient'] = array(
            'limit' => 20,
            'order' => array('Ingredient.count_licenses' => 'DESC'),
        );
        $this->jsonData = array(
            'meta' => array(
                'paging' => $this->request->params['paging'],
            ),
            'data' => $this->paginate($this->Ingredient, $scope),
        );
    }

    public function view($id = null) {
        if (!empty($id)) {
            $ingredient = $this->Ingredient->find('first', array(
                'conditions' => array('id' => $id),
            ));
        }
        if (!empty($ingredient)) {
            $this->paginate['License'] = array(
                'fields' => array(
                    'License.*', 'Drug.id'
                ),
                'limit' => 20,
                'joins' => array(
                    array(
                        'table' => 'ingredients_licenses',
                        'alias' => 'IngredientsLicense',
                        'type' => 'INNER',
                        'conditions' => array(
                            'License.id = IngredientsLicense.license_id',
                            'IngredientsLicense.ingredient_id' => $id,
                        ),
                    ),
                    array(
                        'table' => 'drugs',
                        'alias' => 'Drug',
                        'type' => 'INNER',
                        'conditions' => array(
                            'License.id = Drug.license_uuid',
                        ),
                    ),
                ),
            );
            $items = $this->paginate($this->Ingredient->License);
            $this->jsonData = array(
                'meta' => array(
                    'paging' => $this->request->params['paging'],
                ),
                'data' => $items,
            );
        } else {
            $this->jsonData = array(
                'meta' => array(),
                'data' => array(),
            );
        }
    }

}
