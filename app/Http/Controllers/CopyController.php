<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CopyController extends Controller
{
    public function index(): view
    {
        return view('copy');
    }

    public function copyAcao(Request $request): view
    {
        $client = new Client([
            'base_uri' => 'https://api.openai.com/v1/',
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY')
            ]
        ]);

        $response = $client->post('chat/completions', [
            'json' => [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => 'Responda como um profissional de Copywriter!'],
                    ['role' => 'user', 'content' => 'Quero criar a copy para um produto. O nome do produto é: ' . $request->nome_produto],
                    ['role' => 'user', 'content' => 'O produto será vendido por: R$' . $request->preco_produto],
                    ['role' => 'user', 'content' => 'As principais características do produto são: ' . $request->caracteristicas_produto],
                    ['role' => 'user', 'content' => 'A copy deve ser criada de forma que se comunique bem com o público alvo que é: ' . $request->publico_produto],
                    ['role' => 'user', 'content' => 'O estilo de escrita da copy deve ser muito: ' . $request->estilo_copy],
                ],
                'temperature' => 0.5,
                'max_tokens' => 500
            ]
        ]);

        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);
            $viewData['copyGerada'] = $data['choices'][0]['message']['content'];

            return view('copy', $viewData);
        } else {
            return ['error' => 'Deu algum erro!'];
        }
    }
}
