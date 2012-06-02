# CommonBundle

A collection of classes commonly used throughout my projects

## PLEASE NOTE:

This package is currently broken. It's **experimental** and in the **very** early stages of development so please don't use it if your project is critical... it's no good for that!

If you want to make suggestions though or get involved, you're welcome to. Give me a shout.

# Features
## Entities
This bundle incorporates stof\DoctrineExtensionsBundle and doctrine\DoctrineFixturesBundle to make working with entities slightly easier.

The entities included are:
### BaseEntity
Useful class that adds a standard, integer-based id field and timestampable behaviour on insert and update
#### How to use
 TODO

### BaseUser
A class that adds basic information about a person. Firstname, lastname and date of birth fields are added to any Entity extending from this class.
#### How to use
 TODO

### BaseLookup
There are issues in using Enums in a sqlite database. Mainly because it doesn't support an Enum or anything like it...

So, the BaseLookup makes it easy to add lookup or reference tables to your database as related entities.
#### How to use
 TODO

## DBAL Types
### EnumType
TODO

## Abstract TestCases
### BaseDatabaseTestCase 
TODO

### BaseFixtureLoadingTestCase
TODO

# Installation
## Obtain the Bundle 
add the requirement to your composer.json
	
	{
		"require": {
        	"beldougie/beldougie-common-bundle": "*"
    	}
    }

## Add Bundles to the application kernel
	// app/AppKernel.php
	public function registerBundles()
    {
        $bundles = array(
        	//..
        	new Symfony\Bundle\DoctrineFixturesBundle\DoctrineFixturesBundle(),
        	new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
        	new Beldougie\CommonBundle\BeldougieCommonBundle(),
        	//..
      	)
     }
	
## Configure the bundle
At present, the only configuration options necessary to add are those for Timestampable from the stof\DoctrineExtensionsBundle 

You **must** activate timestampable as the abstract entities included in this bundle use Timestampable in their annotated configuration.

For more detailed information about using other aspects of the DoctrineExtensionsBundle see [the documentation](https://github.com/stof/StofDoctrineExtensionsBundle/blob/master/Resources/doc/index.rst)
 
### Timestampable
	# Stof Doctrine Extensions
	stof\_doctrine\_extensions:
  		orm:
    		default:
      			timestampable: true

# Testing
NB: This section is only relevant if you need to run the BeldougieCommon tests directly within your application for some reason, for example to if you have configuration issues or you want to work on the bundles.

## IMPORTANT!
If you run the tests without having configured a test database, you **WILL** destroy **ALL** of your data irrecoverably.

## Configure the test environment
By default, phpunit will only run tests located in the src/ folder. For this reason, if you don't want to run the tests you don't need to ready any further.

Due to the nature of this bundle the tests included rely on a database. They utilise data fixtures and load automatically when run. Each setup will generate the schema while each teardown DROPS the schema.

We recommend copying phpunit.xml.dist to phpunit.xml and making these changes there. If you add phpunit.xml to .gitignore, it will not get saved in git and the tests will only get run locally on your system and not in a deployment or CI process.

### Add the tests to your phpunit configuration
	<testsuites>
        <testsuite name="Project Test Suite">
            <!-- .... -->
            <directory>../vendor/beldougie/beldougie-*-bundle/Beldougie/*Bundle/Tests</directory>
            <!-- .... -->
        </testsuite>
    </testsuites>
Note the "*" wildcard. Currently, My other bundle(s) use the same naming configuration, so you will only need to do this once.


## Configure an in-memory database
In your app/config/config_test.yml, add the following
 
 	// app/config/config_test.yml
	doctrine:
		dbal:
			driver:   pdo_sqlite
			host:     localhost
			dbname:   db_test
			user:     db_user
			charset:  UTF8
			password: db_pwd
			memory:   true
		orm:
			auto_generate_proxy_classes: true

