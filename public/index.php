<?php
    require_once '../vendor/autoload.php';
    require_once './view/shared/header.php';

    # pagina/id/metodo/component/id
    # api/classe/metodo/parametro
    # admin/pagina/metodo/id

    # importar controllers
    # use App\Controllers\NameController;

    if(isset($_GET['url']))
    {
        $url = explode('/',$_GET['url']);

        var_dump($url);

        //$url = strtolower($url);

        if($url[0] === 'api')
        {
            array_shift($url); //remove o primeiro item do array [0]
            $class = 'App\Controllers\\'.ucfirst($url[0].'Controller');
            array_shift($url);
            $method = strtolower($url[0]); //pega o metodo da requisição
            array_shift($url);
            $params = $url;

            try {
                $response = call_user_func_array(array(new $class, $method), $params);

                #anot: tratar retorno de informação na model

                if($response[0] != 'BAD REQUEST') {
                    # 400 Bad Request - Não foi possível interpretar a requisição. Verifique a sintaxe das informações enviadas. X
                    if($response[0] != 'NOT FOUND'){
                        # 404 Not Found - O recurso solicitado ou o endpoint não foi encontrado. X
                        if($response[0] != 'NO CONTENT'){
                            # 204 No Content - a requisição foi processada com sucesso e não existe conteúdo adicional na resposta X
                            if($response[0] == 'DONE'){
                                # 201 Created - O recurso informado foi criado com sucesso.
                                http_response_code(201);
                                echo json_encode(array('status' => 'success', 'data' => $response[1]), JSON_UNESCAPED_UNICODE);
                                exit;
                            }else if($response[0] == 'OK') {
                                # 200 OK - O recurso solicitado foi processado e retornado com sucesso.
                                http_response_code(200);
                                echo json_encode(array('status' => 'success', 'data' => $response[1]), JSON_UNESCAPED_UNICODE);
                                exit;
                            }else {
                                http_response_code(400);
                                exit;
                            }
                        }else {
                            http_response_code(204);
                            exit;
                        }
                    }else {
                        http_response_code(404);
                        exit;
                    }
                }else{
                    http_response_code(400);
                    exit;
                }
            } catch (\Exception $e) {
                echo json_encode(array('status' => 'error', 'data' => $e->getMessage()), JSON_UNESCAPED_UNICODE);
                exit;
            }
        }
        else if($url[0] === 'admin')
        {
        }
        else
        {
            $page = $url[0];
            
            if($page == "")
            {

            }
            else if($page == "home")
            {
                require_once 'view/landing_page/landing_page.php';
            }
            else if($page == "profile")
            {

            }
            else if($page == "t")
            {

            }
            else if($page == "b")
            {

            }
            else if($page == "login")
            {

            }
            else if($page == "register")
            {

            }

        }
    }

    // $id_page = $url[1];
    // $component = $url[2];
    // $id_component = $url[3];
    // $method = $url[4];

    require_once './view/shared/footer.php';