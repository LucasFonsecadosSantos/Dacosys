<?php

namespace Core;

use App\Models\ResearcherModel;

trait Authenticate
{
    public function login()
    {
        $this->loadView("home/login");
    }

    public function auth($request)
    {
        $result = $this->personModel->getFilteredByColumn('email',$request->post->email)[0];
        
        if ($result && password_verify($request->post->password,$result->password)) {
            $user = [
                'id_person' => $result->id_person,
                'name'      => $result->name,
                'email'     => $result->email
            ];
            Session::set('user', $user);
            return Redirect::route('/');
        }

        return Redirect::route('/login',[
            'errors' => ['Usuário ou senha incorretos.']
        ]);
    }

    public function logout()
    {
        Session::destroy('user');
        return Redirect::route('/login');
    }
}