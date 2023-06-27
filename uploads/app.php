<?php
namespace App;
    require_once "../vendor/autoload.php";
    
    $router = new \Bramus\Router\Router();
    $router->post("/campus/alllocation",function(){
        \App\locations::getInstance(json_decode(file_get_contents("php://input"), true))->getAllLocations();;
    });
    $router->get("/campus/personal_ref",function(){
        \App\personal_ref::getInstance(json_decode(file_get_contents("php://input"), true))->getAllpersonalreference();;
    });
    $router->get("/campus/subjects",function(){
        \App\subjects::getInstance(json_decode(file_get_contents("php://input"), true))->getAllSubjects();;
    });
    $router->get("/campus/workreference",function(){
        \App\work_reference::getInstance(json_decode(file_get_contents("php://input"), true))->getAllworkreference();;
    });
    $router->get("/campus/workinginfo",function(){
        \App\working_info::getInstance(json_decode(file_get_contents("php://input"), true))->getAllworkinginfo();;
    });
    $router->get("/campus/regions",function(){
        \App\regions::getInstance(json_decode(file_get_contents("php://input"), true))->getAllregions();;
    });
    $router->get("/campus/countries",function(){
        \App\countries::getInstance(json_decode(file_get_contents("php://input"), true))->getAllCountries();;
    });
    $router->get("/campus/cities",function(){
        \App\cities::getInstance(json_decode(file_get_contents("php://input"), true))->getAllCities();;
    });
    
    $router->get("/campus/levels",function(){
        \App\levels::getInstance(json_decode(file_get_contents("php://input"), true))->getAllLevels();;
    });
    
    $router->get("/campus/areas",function(){
        \App\areas::getInstance(json_decode(file_get_contents("php://input"), true))->getAllAreas();;
    });
    $router->get("/campus/teameducators",function(){
        \App\team_educators::getInstance(json_decode(file_get_contents("php://input"), true))->getAllTeameducators();;
    });
    $router->get("/campus/journey",function(){
        \App\journey::getInstance(json_decode(file_get_contents("php://input"), true))->getAllJourney();;
    });
    $router->get("/campus/staff",function(){
        \App\staff::getInstance(json_decode(file_get_contents("php://input"), true))->getAllStaff();;
    });
    $router->get("/campus/emergency_contact",function(){
        \App\emergency_contact::getInstance(json_decode(file_get_contents("php://input"), true))->getAllEmergencycontact();;
    });
    $router->get("/campus/position",function(){
        \App\position::getInstance(json_decode(file_get_contents("php://input"), true))->getAllPosition();;
    });
    
    $router->get("/campus/routes",function(){
        \App\routes::getInstance(json_decode(file_get_contents("php://input"), true))->getAllRoutes();;
    });
    $router->get("/campus/thematic_units",function(){
        \App\thematic_units::getInstance(json_decode(file_get_contents("php://input"), true))->getAllThematic_units();;
    });
    $router->get("/campus/chapters",function(){
        \App\chapters::getInstance(json_decode(file_get_contents("php://input"), true))->getAllChapters();;
    });
    $router->get("/campus/themes",function(){
        \App\themes::getInstance(json_decode(file_get_contents("php://input"), true))->getAllThemes();;
    });
    $router->get("/campus/modules",function(){
        \App\modules::getInstance(json_decode(file_get_contents("php://input"), true))->getAllModules();;
    });



  




    $router->run();
    //

    //$obj = new connect();



    // class apiSuperPerrona{
    //     use getInstance;
    //     public function __construct(private $_METHOD, public $_HEADER, private $_DATA){
    //         switch ($_METHOD) {
    //             case 'POST':
    //                 info::getInstance($_DATA['info']);
    //                 break;
    //         }
    //     }

    // }
    // $data = [
    //     "_METHOD"=>$_SERVER['REQUEST_METHOD'], 
    //     "_HEADER"=> apache_request_headers(), 
    //     "_DATA" => json_decode(file_get_contents("php://input"), true)
    // ];
    // apiSuperPerrona::getInstance($data);
    

  
    // factura
    // N de bill
    // Bill Date
    
    // vendedor
    // Seller
    
    
    // cliente
    // Customer identification
    // Full name
    // Email
    // Address
    // Phone
    
    // productos
    // Product Id
    // Product Name
    // Amount
    // Unit value
    










    // print_r(tb_user::getInstance()->getUserId(["n_bill" => 1]));
    // print_r(tb_user::getInstance()->getAllUser());
    // print_r(tb_user::getInstance()->deleteUser(["n_bill" => 1]));

    // $data ='{
    //     "n_bill": 1,
    //     "bill_date": "1998-01-01",
    //     "seller": "a",
    //     "identification": 1,
    //     "full_name": "a",
    //     "email": "a@gmail.com",
    //     "address": "a",
    //     "pone": 1
    // }';
    // print_r(tb_user::getInstance()->putUser(json_decode($data,true)));


    



    // $data ='{
    //     "n_bill": 1,
    //     "bill_date": "2023-03-09",
    //     "seller": "Campus",
    //     "identification": 106465,
    //     "full_name": "Miguel Angel Catsro Escamilla",
    //     "email": "ma@gmail.com",
    //     "address": "Calle 11",
    //     "pone": "30455154845"
    // }';
    // print_r(tb_user::getInstance()->postUser(json_decode($data, true)));
    
?>