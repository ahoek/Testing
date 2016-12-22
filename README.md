UnitTestTutorial
================

Unit tests. Hoe dan?

Dat is de vraag waarop deze handleiding je een antwoord gaat geven. In deze eerste versie zullen we op de volgende onderwerpen inzoomen:

- PHPUnit toevoegen aan je project door middel van Composer
- Een paar conventies bij het schrijven van tests
- Wat is phpunit.xml?
- Het schrijven van een simpele unit test
- Het gebruik van een DataProvider
- Testen in Symfony
- Code Coverage en CRAP
- Mock objects in de "Ramp it up!"

### 1. PHPUnit in je Composer project

Controleer eerst in je `composer.json` file of je onder `require-dev` al een dependency voor `phpunit/phpunit` ziet staan. Is dit het geval? Dan kun je deze stap overslaan!

Navigeer met de command line naar je project toe, en voer het volgende commando uit:

`composer require phpunit/phpunit --dev`

Als Composer geen foutmeldingen geeft, en je ziet het volgende terug in je `composer.json` ben je klaar om door te gaan naar de volgende stap!

    "require-dev": {
        "phpunit/phpunit": "^5.7"
    }

Voor de zekerheid kun je het volgende commando uitvoeren vanuit je project-folder:

`./vendor/bin/phpunit -v`

Dit zou je een kort overzicht moeten geven van de verschillende opties die het phpunit command te bieden heeft.

### 2. Conventies

Er zijn een paar conventies die het leven met PHPUnit makkelijker maken.

#### Folder structuur

De folder structuur voor je test classes is hetzelfde als de codebase, maar dan in een folder genaamd test.

Voor de volgende files

```
src/AppBundle/Controller/DefaultController.php
src/AppBundle/Util/Slugify.php
```

Zouden de tests op de volgende manier gemaakt moeten worden:

```
tests/AppBundle/Controller/DefaultControllerTest.php
tests/AppBundle/Util/SlugifyTest.php
```

#### Bestands- en classnamen

Net als "normaal", de bestandsnaam is hetzelfde als de class die je definieert in het bestand. Als een class in de codebase `Math` heet, zal de bijhorende test `MathTest` heten. We voegen altijd "Test" toe aan de naam.

#### Methodes

Een test methode is altijd `public`.

Een test methode start altijd met het woord 'test' in kleine letters, en beschrijft daarna wat de test gaat controleren.

Als je bijvoorbeeld een methode gaat testen die `verifyAccount()` heet, en je gaat controleren of een account wachtwoord gelijk is, is `testVerifyAccountMatchesPasswordGiven()` een prima test-naam.

Dit helpt later in het proces (als er tests falen) met in een oog opslag zien wat er mis gegaan is.

#### Extenden van PHPUnit_Framework_TestCase

Bij gebruik van PHPUnit is het belangrijk dat iedere test-class uiteindelijk extend van `PHPUnit_Framework_TestCase`.

### 3. phpunit.xml

Alle PHPUnit configuratie staat in deze file, in je project-root. (Zie ook de phpunit.xml.dist file in deze voorbeeld-codebase)

Als je wilt weten wat je nog meer allemaal in deze file kunt instellen kun je dat hier vinden:

https://phpunit.de/manual/current/en/appendixes.configuration.html

Het belangrijkste onderdeel van deze configuratie is het volgende stuk:

```
    <testsuites>
        <testsuite name="Unit Test Tutorial Tests">
            <directory>tests</directory>
        </testsuite>
    </testsuites>
```

Hiermee vertel je PHPUnit dat alles wat hij tegen komt onder de project-directory `tests`, ook daadwerkelijk getest moet worden.


### 4. Aan de slag!

#### Rustig aan beginnen

We gaan beginnen met een eerste simpele testcase!

Maak eerst in de folder `tests/AppBundle` een file die heet `SimpleTest.php`, en voeg de volgende inhoud toe:

```php
<?php

namespace Tests\ConnectHolland\UnitTestTutorial\AppBundle;

use PHPUnit_Framework_TestCase;

class SimpleTest extends PHPUnit_Framework_TestCase
{
    //
}
```

Nu kunnen we aan de slag met het daadwerkelijk schrijven van een hele simpele test, we gaan controleren of true inderdaad hetzelfde is als true.

Voeg in de net aangemaakte class de volgende method toe:

```php
public function testBarIsTrue()
{
    $bar = true;
    $this->assertTrue($bar);
}
```

Deze methode gaat controleren of `$bar` daadwerkelijk `true` is, en als dat zo is slaagt onze eerste test!

Om PHPUnit te vragen alle tests uit te voeren, kun je op de command line vanuit je project root het volgende commando uitvoeren:

`vendor/bin/phpunit`

Als het goed is zie je nu een grote groene balk, waarin staat:

`OK (1 tests, 1 assertions)`


#### Wat hebben we net gedaan? En wat is dat `assert`?

Op Wikipedia staat de volgende definitie van een "assertion":

> Een assertie (Engels: assertion) is in programmeertalen een predicaat (waar of onwaar) dat door de ontwikkelaar in de broncode van een computerprogramma geplaatst kan worden om aan te geven dat een bepaalde voorwaarde op die plaats altijd als waar wordt verondersteld.

Met een assertie geven we dus aan dat we zeker weten of een bepaalde voorwaarde `true` of `false` is. Als dat niet zo is, faalt onze unit test.

In PHPUnit zijn standaard veel assertions aanwezig. De volledige lijst vind je hier:

https://phpunit.de/manual/current/en/appendixes.assertions.html

Veel gebruikte assertions zijn de volgende:

- [`assertTrue()`](https://phpunit.de/manual/current/en/appendixes.assertions.html#appendixes.assertions.assertTrue)
- [`assertFalse()`](https://phpunit.de/manual/current/en/appendixes.assertions.html#appendixes.assertions.assertFalse)
- [`assertEquals()`](https://phpunit.de/manual/current/en/appendixes.assertions.html#appendixes.assertions.assertEquals)
- [`assertSame()`](https://phpunit.de/manual/current/en/appendixes.assertions.html#appendixes.assertions.assertSame)
- [`assertArrayHasKey()`](https://phpunit.de/manual/current/en/appendixes.assertions.html#appendixes.assertions.assertArrayHasKey)

#### En nu echt aan de slag!

Om een paar mooie testcases te schrijven hebben we eerst wat logica nodig. In dit voorbeeld project vind je de volgende class:

`src/AppBundle/Util/Slugify.php`

Deze utility zal ons helpen bij het creeren van slugs, en moeten we natuurlijk goed en uitgebreid testen!

Om te beginnen moeten we in de `tests/` folder zorgen dat er een `SlugifyTest` class komt, die extend van `PHPUnit_Framework_TestCase`.

Als je dit gedaan hebt, gaan we onze eerste testcase maken!

Onze utility zou de string `dit is een string` om moeten zetten naar `dit-is-een-string`. Om te controleren of dat ook echt werkt schrijven we de volgende test:

```phpphp
public function testSlugifyReturnsSlugifiedString()
{
    $originalString = 'dit is een string';

    $result = Slugify::slugify($originalString);

    $this->assertEquals('dit-is-een-string', $result);
}
```

Als je nu vanaf de command line weer `vendor/bin/phpunit` uitvoert, zou je moeten zien dat er 2 tests (succesvol) uitgevoerd zijn:

`OK (2 tests, 2 assertions)`


### meer tests!

We hebben nu gecontroleerd of onze Slugify-util een vrij eenvoudige A-Z met spaties string om kan zetten naar een slug. Maar wat gebeurd er als er speciale karakters (`!@#$%^&`) opgenomen worden in de string? Werkt het dan nog steeds? Wat gebeurd er bij het uitvoeren van de utility als je er een lege string in stopt?

Maak 2 tests die deze scenarios controleert, en lees verder als je hiermee klaar bent!


### DRY ? @dataProvider !

Na het schrijven van 3 van dit soort tests gaat er in de doorgewinterde programmeur als het goed is een alarmbel af. We hebben geleerd om tijdens het programmeren niet in herhaling te vallen! `DRY`, ofwel `Don't repeat yourself!`

Gelukkig bied PHPUnit ons een heerlijk eenvoudige oplossing om dit probleem in onze tests op te lossen, en die heet ... `@dataProvider`!

https://phpunit.de/manual/current/en/appendixes.annotations.html#appendixes.annotations.dataProvider

In de documentatie beschrijven ze deze op de volgende manier:

> A test method can accept arbitrary arguments. These arguments are to be provided by a data provider.

In plaats van dus in herhaling te vallen, kunnen we 1 test methode schrijven, en die hergebruiken!

Dat gaat als volgt:

```php
/**
 * @dataProvider providerTestFoo
 */
public function testFoo($variableOne, $variableTwo)
{
    //
}

public function providerTestFoo()
{
    return [
        ['test 1, variable 1', 'test 1, variable 2'],
        ['test 2, variable 1', 'test 2, variable 2'],
        ['test 3, variable 1', 'test 3, variable 2'],
        ['test 4, variable 1', 'test 4, variable 2'],
        ['test 5, variable 1', 'test 5, variable 2'],
    ];
}
```

In het bovenstaande voorbeeld zal bij het runnen van de tests, de `testFoo` methode 5x aangeroepen worden met steeds verschillende `$variableOne` en `$variableTwo`'s.

Tip: een DataProvider kan natuurlijk ook één of meer dan twee argumenten aan een methode meegeven.

Voeg deze manier van testen toe aan een nieuwe test class `DRYSlugifyTest`, en voer dezelfde tests uit als in de `SlugifyTest` class.

### Symfony

In onze projecten gebruiken we het Symfony framework (ook dit voorbeeld is een Symfony App). In de documentatie van Symfony staat heel goed uitgelegd hoe je het beste kunt testen in een Symfony applicatie.

https://symfony.com/doc/current/testing.html

In dit voorbeeld vind je al een `DefaultControllerTest` class. Probeer deze Test uit te breiden om te controleren dat een niet gevonden pagina ook daadwerkelijk een 404 status code terug geeft!


### Coverage en Change Risk Analysis and Predictions (CRAP)

Twee termen die je ongetwijfeld al voorbij hebt horen komen, maar wat betekenen ze precies?

#### Coverage

We beginnen met Coverage, dit wordt weergegeven in een percentage. Waarbij een code-coverage van 100% betekent dat alle regels code in je codebase doorlopen worden in de unit tests. Je wilt natuurlijk niet zelf alle code doorlopen met een telraam om te controleren hoeveel code-coverage je met je tests haalt, dus vandaar dat PHPUnit de mogelijkheid biedt om een mooi rapport te genereren.

Voor projecten kan in het Continuous Integration proces een stap opgenomen worden die dit rapport genereert, maar je kunt het ook zelf genereren:

Voer phpunit uit, maar nu met de volgende command line opdracht:

`vendor/bin/phpunit --coverage-html coverage`

##### xdebug?

Let op: Waarschijnlijk zal het uitvoeren van dit commando niet succesvol gaan, en zal de volgende foutmelding te zien zijn:

`Error: No code coverage driver is available`

Dit komt dan omdat er geen xdebug extentie geladen is in je PHP. Door de vertraging die deze extentie oplevert bij bijvoorbeeld gebruik van Composer, is dit ook zeker niet standaard aan te raden.

Als je WEL graag het rapport wil kunnen maken, is het mogelijk om de xdebug extentie te installeren, maar niet standaard in de php.ini aan te zetten.

Op de dev VM's staat xdebug vaak al geinstalleerd, op een mac kun je het installeren met het volgende commando:

`brew install php56-xdebug`

Als je dan phpunit uitvoert met het volgende commando, dan zal de coverage-file netjes gegenereerd worden in de folder `coverage`:

(mac)
`php -dzend_extension=/usr/local/opt/php56-xdebug/xdebug.so vendor/bin/phpunit --coverage-html coverage`

(dev vm)
`php -dzend_extension=/usr/lib/php5/20131226/xdebug.so vendor/bin/phpunit --coverage-html coverage`

Als je nu op dit moment op je machine geen xdebug wilt installeren, kun je een voorbeeld van een code-coverage rapportage bekijken op de volgende URL:

https://coveralls.io/github/accompli/accompli

#### CRAP

Een goede uitleg van CRAP kun je vinden op de volgende URL:

http://www.slideshare.net/rdohms/your-code-sucks-lets-fix-it-15471808

### Ramp it up!

Simpele methodes laten zich op deze manier makkelijk testen. Maar wat als je een class wil testen die op zijn beurt weer gebruik maakt van een andere class voor het ophalen van wat data?

Een unit test heeft als doel een zo klein mogelijk stukje logica testen, dus je wilt niet dat er voor jouw unit test een hele ketting aan classes geïnstantieerd moet worden, die op hun beurt ook weer veel logic bevatten. Dan ben je namelijk niet meer uitsluitend de functionaliteit van de class die je wilt testen aan het testen, maar ben je straks in 1 method call je hele framework aan het doorlopen.

In de codebase zit een folder "Payment", dit is een voorbeeld van hoe een betaling naar Paypal in elkaar zou kunnen zitten.

Laten we beginnen met een `ProcessorTest`, zodat we de werking van de `Processor` kunnen testen.

Deze class roept de methode `processPayment` aan op een `Provider`, en set op het terugkerende `Result` de boolean `$processorPassed` naar `true`. Hierna retourneerd

Het doel van onze eerste unit test is controleren of de `Processor` dit werk inderdaad goed doet.

```php
public function testPaymentSuccess() 
{
    $payment = new Payment(12.25);

    $paypal = new PayPalProvider();

    $processor = new Processor($paypal);

    $result = $processor->doPayment($payment);

    $this->assertTrue($result->isProcessorPassed());
    $this->assertTrue($result->isSuccess());
}
```

Zo. Klaar.

Alleen.. Als we de tests runnen zien we de volgende melding:

`Whoops! This would actually connect to PayPal, and that is not something you would want in a unit test!`

Wat we hier dus zien is dat we een `PayPalProvider` moeten maken, om de `Processor` te kunnen testen.. En zoals we hierboven beschreven, willen we juist alleen de `Processor` testen.

Een van de ons beschikbare oplossingen is het "mocken" van de `PayPalProvider` class, en dat gaat als volgt:

Vervang de regel `$paypal = new PayPalProvider();` door de volgende code:

```php
$result = new Result();                                     /// 1
$result->setSuccess(true);
$result->setTransactionId(1);

$paypal = $this->getMockBuilder(PayPalProvider::class)      /// 2
    ->getMock();

$paypal->expects($this->once())                             /// 3
    ->method('processPayment')
    ->will($this->returnValue($result));
```

/// 1: Hier maken we alvast een `Result` object aan. Normaliter maakt de `PayPalProvider` deze in de `processPayment` methode.

/// 2: We vragen aan de `MockBuilder` van PHPUnit om voor ons een Mock object van de `PayPalProvider` class te maken.

/// 3: en vertellen dit Mock object dat als de methode `processPayment` aangeroepen wordt altijd het `Response` object uit stap 1 terug gegeven moet worden.

Als we daarna onze tests uitvoeren, zien we dat onze beide asserties nu succesvol zijn! De boolean `ProcessorPassed` is door de `Processor` op `true` gezet!


Tip: er is heel erg veel mogelijk met de PHPUnit Mock objecten. Lees hiervoor de documentatie op:
https://phpunit.de/manual/current/en/test-doubles.html#test-doubles.mock-objects
