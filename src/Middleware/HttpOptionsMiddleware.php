<?php
namespace App\Middleware;

class HttpOptionsMiddleware
{
    use \Cake\Log\LogTrait;
    /**
     * HttpOptionsMiddleware
     * When developing in the create-react-app development environment
     * this middleware inspects the HTTP_ORIGIN and then adds the correct headers to allow
     * for Cross Origin Resource Requests from the development environment
     * @return function
     */
    public function __invoke($request, $response, $next)
    {
        $myOrigins = ['http://localhost:3000', 'http://10.19.73.29:3000', 'http://localhost', 'http://10.19.73.30:3000'];
        $httpOrigin = $request->getEnv('HTTP_ORIGIN');
        // $this->log($request->env('HTTP_ORIGIN'));
        if (in_array($httpOrigin, $myOrigins)) {
            $response = $response->withHeader('Access-Control-Allow-Origin', $httpOrigin);
        }
        $response = $response->withHeader('Access-Control-Allow-Credentials', 'true');

       if ($request->getMethod() == 'OPTIONS') {
            $method = $request->getHeader('Access-Control-Request-Method');
            $headers = $request->getHeader('Access-Control-Request-Headers');
            $allowed = empty($method) ? 'GET, POST, PUT, DELETE' : $method;

            $response = $response
                ->withHeader('Access-Control-Allow-Headers', $headers)
                ->withHeader('Access-Control-Allow-Methods', $allowed)
                ->withHeader('Access-Control-Allow-Credentials', 'true')
                ->withHeader('Access-Control-Max-Age', '86400');

            return $response;
        }

        return $next($request, $response);
    }
}
