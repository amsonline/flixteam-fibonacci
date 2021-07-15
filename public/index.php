<?php
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Slim\Factory\AppFactory;
    use DI\Container;
    use AMSOnline\FibonacciCalculator;
    use AMSOnline\Fibonacci;
    use AMSOnline\Exceptions\InvalidInputException;
    use AMSOnline\Exceptions\OutOfRangeException;

    require_once __DIR__ . '/../vendor/autoload.php';

    $container = new Container();
    $container->set('fibonacciCalculator', function() {
        return new FibonacciCalculator();
    });

    AppFactory::setContainer($container);
    $app = AppFactory::create();

    $app->post('/fibonacci', function (Request $request, Response $response, array $args) use($app) {
        /**
         * @var Fibonacci $fibonacci
         */
        $fibonacci = $this->get('fibonacciCalculator');
        $responseData = [
            'success'       => false
        ];

        $statusCode = 200;
        try {
            // Getting form data
            $formData = json_decode($request->getBody());

            // Validating input
            if ($formData == null || !isset($formData->number)) {
                throw new InvalidInputException();
            }
            if (!is_int($formData->number)) {
                throw new InvalidInputException();
            }
            $number = $formData->number;
            $result = $fibonacci->getNumber($number);
            $responseData['result'] = number_format($result,0,'.','');
            $responseData['success'] = true;
        }catch (OutOfRangeException $e) {
            // In case the value is out of range
            $responseData['message'] = $e->getMessage();
            $statusCode = 400;
        }catch (InvalidInputException $e) {
            // In case input is not an integer
            $responseData['message'] = "Invalid input. You must pass the number as an integer inside 'number' key in a JSON string.";
            $statusCode = 400;
        }catch (Throwable $e) {
            // In case any other errors
            $responseData['message'] = "Something went wrong";
            $statusCode = 500;

            // TODO adding logger could be helpful to get detailed info about the error
        }

        $payload = json_encode($responseData);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')
                        ->withStatus($statusCode);
    });

    $app->run();