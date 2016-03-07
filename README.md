# Intro

This app uses Symfony 2.8. My controllers are not defined as services, although I would do that for a large scale application to break away from being tightly coupled to a framework. I also think using controllers are services leads to better dependency injection as there is no service container being passed around.

In the DefaultController::indexAction I opted to have 2 return statements as I think it looks cleaner and easier to implement. Some people would argue that it thank you page should have been defined as a different route, i.e. /thanks

The system uses a RESTCounties client defined as a service. It is being passed as a dependency to the Application Form type.

Application form type is also defined as a service, where I pass RESTCountriesClient as a dependency. I chose to use this route as this makes easier to create reusable forms, and makes the system more loosely coupled.

For DB interaction I used Doctrine, and my Entity has annotations that define the fields. There are also annotations that enforce specific validation rules on those fields. Some getters/setter there are unused in the app, but I decided it is better to have them for consistency sake.

There are two views in the app - views/default/index.html.twig and thanks.html.twig.

My tests both cover the integration testing and unit testing. 

For unit testing I used a hacky approach of modifying a class protected property to replace underlying Guzzle client. Given more time I would manage this dependency better and mocking Guzzle would have been easier. I also used method chaining in stubbing, so instead of defining two mocks, I needed just one.

Integration tests use WebTestCase that imitates a browser behaviour through faking requests. This allows us to see the code coverage in integration tests.

# Installation

Clone the repository and run

    composer install

# Usage

Navigate to an index page. in dev mode i.e.           

    http://symfonydemo.dev/app.php/
    
# Testing

There is one integration, and one unit tests

    composer tests

PHPUnit will generate code coverage and CRAP rating reports in reports folder

