<?php
    
    namespace App\Providers;
    
    use Illuminate\Support\ServiceProvider;
    use Illuminate\Support\Facades\Response;
    
    class RequestCachingMacroServiceProvider extends ServiceProvider
    {
        /**
         * Register services.
         *
         * @return void
         */
        public function register()
        {
            //
        }
        
        /**
         * Bootstrap services.
         *
         * @return void
         */
        public function boot()
        {
            Response::macro('shortSpanCacheResponse', function ($data, $status) {
                return Response::json($data, $status)
                                ->withHeaders([
                                    'Cache-Control' => 'max-age:3600'
                                ]);
            });
        }
    }
