<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Configuracao;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    

    public function obterValorConfiguracao($chave) {
        
        $retorno = "";
        
        if(is_array($chave)) {
            $configuracoes = DB::table("configuracoes")->whereIn("chave", $chave)->pluck("chave", "valor")->all();
            if(!empty($configuracoes)) {
                $retorno = array_flip($configuracoes);
            }
        } else {
            $configuracao = Configuracao::where("chave", $chave)->select("valor")->first();
            if(!empty($configuracao)) {
                $retorno = $configuracao->valor;
            }
        }
        
        if(empty($retorno)) {
            $msgErroConf = is_array($chave) ? "Configurações não definidas: " . implode(", ", $chave) : "Configuração não definida: " . $chave;
            toastr()->error($msgErroConf);
        }

        return $retorno;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {        
        
        $id = Cliente::create([
            'nome' => $data['name'],
            'email' => $data['email'],            
            "valor_saldo" => moneyToFloat($this->obterValorConfiguracao("VALOR_SALDO_INICIAL_CLIENTE"))
        ])->id;
        
        $this->redirectTo = '/pedido';

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'perfil_id' => $this->obterValorConfiguracao("ID_PERFIL_CLIENTE"),
            'cliente_id' => $id 
        ]);
    }
}
