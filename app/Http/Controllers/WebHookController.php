<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\WebHooks;
use Illuminate\Support\Facades\Log;
use App\Option;
use Hiweb\HiwebApiClient\Client;
use Hiweb\HiwebApiClient\ResourceManager;

class WebHookController extends Controller
{

    public function show(Request $request)
    {
        return view('welcome');
    }
    
    public function index(Request $request)
    {
        $header = $request->header();
        $body = json_decode($request->getContent(),true);
        $appSecreyKey = 'a577674a0a24ba5de0e8b143ff63b29641e467006328ea508db11966991493e9';
        $key = hash_hmac('sha256', $request->getContent(), $appSecreyKey);
        $signatureHiweb = $header['hiweb-webhook-signature'][0];
        $data["signatureHiweb"] = $signatureHiweb;
        $data["key"] = $key;

        if ($key == $signatureHiweb) {

            $token = $body["data"]["attributes"]["token"];
            $website_id = $body["data"]["attributes"]["website_id"];
            $option = new Option();
            $option->website_id =  $website_id;
            $option->token =  $token;
            $option->save();

            return $option;

        }else{
            return redirect('/403');
        }
        // event(new WebHooks($data));
        return $data;

    }

    public function create(Request $request)
    {
        // API Endpoint
        $endpoint = 'https://hiweb.io/api/';
        // Create a HTTP Client
        $client = new Client($endpoint);

        $option = Option::orderBy('created_at', 'desc')->first();
        $token = $option->token;
        $website_id = $option->website_id;

        // // Set website id
        $client->setWebsiteId($website_id);
        $client->setHeaders(['Hiweb-App-Id' => '024f01f0-fa93-4767-8868-462495fd1fa8']);

        // // Set token
        $client->setToken($token);
        $productManager = new ResourceManager('products', $client);
        // // Create product
        $newProduct = $productManager->create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'compare_at_price' => $request->input('compare_at_price'),
        ]);

        return $newProduct; 

    }

}
