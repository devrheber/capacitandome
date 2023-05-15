<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Lyra;

class PaymentGatewayServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(Lyra\Client::class, function ($app) {

            /* Username, password and endpoint used for server to server web-service calls */
            ///// Developer 
            /*
            Lyra\Client::setDefaultUsername("76709216");
            Lyra\Client::setDefaultPassword("testpassword_H2dVCRsEdE6QUMcU3gi9R6FGDivKJfRmcdNrJFCtXdsdo");
            Lyra\Client::setDefaultEndpoint("https://api.micuentaweb.pe");
            */
            /* publicKey and used by the javascript client */
            //Lyra\Client::setDefaultPublicKey("76709216:testpublickey_1fPQ9pbCE9K8fEv5ZP4JjGa9ml3lfWjFcmXshDgeoyqm0");

            /* SHA256 key */
            //Lyra\Client::setDefaultSHA256Key("SWswSssuN4m6SFtV99WFMNQYEaXYw6TybU1bLClRA9trv");
            
            ///Production
        
            Lyra\Client::setDefaultUsername("76709216");
            #6Ht0uq3zsGrPj2Pg
            Lyra\Client::setDefaultPassword("prodpassword_6BheD75ZZGMFTnAU6WQO3YrumqI4uVHkRrzr7CnKv3aVQ");
            Lyra\Client::setDefaultEndpoint("https://api.micuentaweb.pe");
        
            /* publicKey and used by the javascript client */
            Lyra\Client::setDefaultPublicKey("76709216:publickey_iR5E7efvjhbZhlZyCD0Y3Tq8HTgzb0MgN0srv5D7y4BLr");

            /* SHA256 key */
            Lyra\Client::setDefaultSHA256Key("cweKkpcvwqPi3A7H6TJkKbI9f22GRb7eKsZG7gma0WDlp");


            return new Lyra\Client();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
