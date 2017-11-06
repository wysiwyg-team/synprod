<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    public $data =[];
    public function __construct(){
        $this->data = [
            'activeMenu'=>0,
            'bannerText'=>'Connectez vos applications ensemble',
            'bannerMore'=>'Voir plus.',

        ];
    }
}
