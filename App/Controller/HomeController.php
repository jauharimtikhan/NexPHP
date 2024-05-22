<?php

namespace App\Controller;

use App\Helpers\Date;
use App\Models\HomeModel;
use System\Controller;
use System\FormValidation\Validator;

class HomeController extends Controller
{
    private $helper;

    public function __construct()
    {
    }

    public function index()
    {
        $name = $this->input('name');

        $data = [
            'name' => $name
        ];

        $rules = [
            'name' => 'required|min:3'
        ];

        $validator = new Validator($data, $rules);

        if ($validator->validate()) {
            echo $name;
        } else {
            $errors = $validator->errors();
            foreach ($errors as $field => $messages) {
                foreach ($messages as $message) {
                    echo "<p>$message</p>";
                }
            }
        }
    }

    public  function show()
    {
        $products = HomeModel::getProduct();

        $data = [
            'nama' => 'jauhar-imtikhan',
            'products' => $products,
            'tahun' => $this->helper->getYear()
        ];
        $this->view('Home', $data);
    }
}
