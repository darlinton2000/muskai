<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    public function index(Request $request): view
    {
        return view('welcome');
    }

    public function ingredientesAcao(Request $request): view
    {
        $client = new Client([
            'base_uri' => 'https://api.openai.com/v1/',
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY')
            ]
        ]);

        $response = $client->post('completions', [
            'json' => [
                'model' => 'text-davinci-003',
                'prompt' => 'Gere uma receita incrível somente com os seguintes ingredientes:' . $request->ingredientes . 'Não inclua ingredientes extras! Se não conseguir gerar a receita, responda: "Impossível, vá ao mercado"',
                'temperature' => 0.5,
                'max_tokens' => 500
            ]
        ]);

        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);
            $viewData['ingredientes'] = $request->ingredientes;
            $viewData['receita'] = $data['choices'][0]['text'];

            return view('welcome', $viewData);
        } else {
            return ['error' => 'Deu algum erro!'];
        }
    }
}

