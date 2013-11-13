ClarityPredictionIOBundle Emergency
==========================

Nice to see you learning our ClarityPredictionIOBundle!

**Basics**

* [Installation](#installation)
* [Usage](#usage)

<a name="installation"></a>

## Installation

### Step 1) Get the bundle

#### Simply using composer to install bundle (symfony from 2.1 way)

    "require" :  {
        // ...
        "clarity-project/predictionio-bundle": "dev-master"
        // ...
    }

You can try to install ClarityPredictionIOBundle with `deps` file (symfony 2.0 way) like here -  [Symfony doc](http://symfony.com/doc/2.0/cookbook/workflow/new_project_git.html#managing-vendor-libraries-with-bin-vendors-and-deps), 
or with help of `git submodule` functionality - [Git doc](http://git-scm.com/book/en/Git-Tools-Submodules#Starting-with-Submodules).
But it's not tested ways! If you cat do it - just send approve to us, or fork and edit this documentation to solve our doubts =)

### Step 2) Register the namespaces

If you install bundle via composer, use the auto generated autoload.php file and skip this step.
Else you may need to register next namespace manualy:

``` php
<?php
// app/autoload.php
$loader->registerNamespaces(array(
    // ...
    'Clarity\PredictionIOBundle' => __DIR__ . '/../vendor/clarity-project/predictionio-bundle/Clarity/PredictionIOBundle',
    // ...
));
```

### Step 3) Register new bundle

Put new line into AppKernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Clarity\PredictionIOBundle\ClarityPredictionIOBundle(),
    );
    // ...
}
```

<a name="usage"></a>

## Usage

For using client from [official PHP-SDK](https://github.com/PredictionIO/PredictionIO-PHP-SDK) as service in symfony you are just need add configuration:

``` yml
# app/config/config.yml

# ...
prediction_io:
    app_key: some_long_long_long_long_long_long_long_long_app_key
    api_url: http://localhost:8000 # it is default value
# ... 
```

After that you are able to call the client instance through container:

``` php 
<?php

// any php class with access to container
// ...
    public function someMethod()
    {
        $client = $this->container->get('prediction_io.default_client'); 
        // $client instance of PredictionIO\PredictionIOClient
    }
// ...
```

Your client has name `..default_client` because in official SDK you are creating your client through factory method. So our implementation for symfony allows to create multiple clients:

``` yml
# app/config/config.yml

# ...
prediction_io:
    first_app:
        app_key: first_app_long_long_long_long_long_long_long_long_app_key
        api_url: http://localhost:8000 # it is default value
    second_app:
        app_key: second_app_long_long_long_long_long_long_long_long_app_key
    third_app:
        app_key: third_app_long_long_long_long_long_long_long_long_app_key
# ... 
```

After that you are able to use all of them:

``` php 
<?php

// any php class with access to container
// ...
    public function someMethod()
    {
        $firstClient = $this->container->get('prediction_io.first_app_client');
        $secondClient = $this->container->get('prediction_io.second_app_client');
        $thirdClient = $this->container->get('prediction_io.third_app_client'); 
        // $*Client instances of PredictionIO\PredictionIOClient
    }
// ...
```

Thanks for reading & using! =)
