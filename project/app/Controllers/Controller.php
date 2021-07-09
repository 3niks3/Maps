<?php
namespace App\Controllers;

use App\Core\Database;
use App\Core\MasterController;
use App\Core\Validator;
use App\Models\Subscription;
use App\Models\Users;
use phpDocumentor\Reflection\Types\Integer;
use App\Services\MapsService;

class Controller extends MasterController
{

    public function index()
    {
        $this->view('home');
    }

    public function auth()
    {
        $email = trim($this->request->get('post', 'email'));
        $password = trim($this->request->get('post', 'password'));

        $fields = ['email' => $email , 'password' => $password];

        $rules = [
            'email' => ['required', 'email'],
            'password' => ['required']
        ];

        $messages = [
            'email' => [
                'required' => 'Email address is required',
                'email' => 'Please provide a valid e-mail address',
            ],
            'password' => [
                'required' => 'Password is required',
            ]
        ];

        $validator = new Validator($fields,$rules,$messages);
        $validator->validate();

        if($validator->failed()) {

            $messages = $validator->getFirstMessages();
            echo json_encode(['status' => false, 'messages' => $messages]);
            die();
        }

        $password = sha1($password);
        $checkAuth = Users::checkAuth($email, $password);

        if( !($checkAuth['status'] ?? false) ) {
            $messages = 'Incorrect username or password';
            echo json_encode(['status' => false, 'messages' => ['general' => $messages]]);
            die();
        }



        $user_id = $checkAuth['user']['id'];

        $this->request->setLoginUser($user_id);

        echo json_encode(['status' => true, 'messages' => []]);
        die();
    }

    public function logout()
    {
        session_destroy();
        header('Location: /');
        exit;
    }

    public function profile()
    {
        $key = '5333a9720180356462a0d9615a38f6dfff4581aa';
        $map_service = new MapsService($key);

        $unit = $map_service->getUnitList();

        $unit_id = $data['data']['units'][0]['unit_id']??null;
        $till_date = date('Y-m-d\TH:i:sp');
        $from_date = date('Y-m-d\TH:i:sp', strtotime('2021-07-01'));

        $params = [
            'from' => $from_date,
            'till' => $till_date,
            'unit_id' => $unit_id,
            'include' => 'polyline',
        ];

        $routes_data = $map_service->getRoutes($params);
        $routes_data = $routes_data['data']['units'][0]['routes'];



        $cord_data = $map_service->formatData($routes_data);
        $markers_data = $cord_data['markers'];
        $pollylines_data = $cord_data['pollylines'];


        $this->view('maps',['markers_data' => json_encode($markers_data), 'pollylines_data' => json_encode($pollylines_data)]);
    }

    public function updateMap()
    {
        dd('updateMap');
    }

//    public function dbTest()
//    {
//        Database::insert('test', ['text' => 'Hello123', 'date' => date('Y-m-d H:i:s')]);
//        Database::insert('test', ['text' => 'Hello123', 'date' => date('Y-m-d H:i:s')]);
//        Database::insert('test', ['text' => 'Hello123', 'date' => date('Y-m-d H:i:s')]);
//
//        Database::update('test', ['text' => 'Hello', 'date' => date('Y-m-d H:i:s')],'id = ?', 2);
//
//        $rows = Database::getRows('Select * from test where id > ?', [1]);
//        $row = Database::getRecord('Select * from test where id > ?', [1]);
//
//    }

    public function testModels()
    {
        dd('test models');
    }
}