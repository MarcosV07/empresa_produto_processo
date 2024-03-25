<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Endereco;

class EnderecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$file = fopen(storage_path("ceps.txt"), "r");
        while(!feof($file)) {
            $colunas = explode("\t", fgets($file));
            
            $cep = "";
            $estado = "";
            $cidade = "";
            $bairro = "";
            $logradouro = "";
            $complemento = "";

            if(isset($colunas[0])) {
                $cep = $colunas[0];
            }

            if(isset($colunas[1])) {
                list($cidade, $estado) = explode("/", $colunas[1]);
            }

            if(isset($colunas[2])) {
                $bairro = $colunas[2];
            }

            if(isset($colunas[3])) {
                $logradouro = $colunas[3];
            }

            if(isset($colunas[4])) {
                $complemento = $colunas[4];
            }

            Endereco::create([
                "cep" => $cep,
                "estado" => $estado,
                "cidade" => $cidade,
                "bairro" => $bairro,
                "logradouro" => $logradouro,
                "complemento" => $complemento
            ]);
        }
        
        fclose($file);*/
    }
}
