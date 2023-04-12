<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class WebPageTest extends TestCase
{
    /**
     * Les propriétés attendues pour la classe testée.
     */
    private array $expectedProperties = ['head', 'title', 'body'];

    /**
     * Permet de consulter la valeur d'une propriété, même privée, d'un objet.
     *
     * Utilisé pour les tests.
     *
     * @param object $object L'objet dont on souhaite consulter la propriété
     * @param string $propertyName Le nom de la propriété que l'on souhaite consulter
     *
     * @return mixed La valeur de la propriété consultée
     *
     * @throws ReflectionException Lorsque la propriété n'existe pas
     */
    private static function getPropertyValue(object $object, string $propertyName): mixed
    {
        $reflection = new \ReflectionObject($object);
        if (!$reflection->hasProperty($propertyName)) {
            throw new ReflectionException("Unknown property {$propertyName}");
        }
        $property = $reflection->getProperty($propertyName);
        $property->setAccessible(true);
        return $property->getValue($object);
    }

    /**
     * Surcharge la méthode assertClassHasAttribute qui disparaitra dans PHPUnit 10
     */
    public static function assertClassHasAttribute(string $attributeName, string $className, string $message = ''): void
    {
        $reflection = new \ReflectionClass($className);
        self::assertTrue($reflection->hasProperty($attributeName), 'Failed asserting that class "' . $className . '" has attribute "' . $attributeName . '".');
    }

    /**
     * Teste que la classe possède les propriétés attendues.
     */
    public function testExpectedProperties()
    {
        $webPage = new WebPage();

        foreach ($this->expectedProperties as $expectedProperty) {
            $this->assertClassHasAttribute($expectedProperty, get_class($webPage));
        }
    }

    /**
     * Teste que la classe ne possède que les propriétés attendues.
     */
    public function testUnexpectedProperties()
    {
        $webPage = new WebPage();
        // Other properties ?
        $reflection = new \ReflectionClass(get_class($webPage));
        foreach ($reflection->getProperties() as $property) {
            $this->assertTrue(
                in_array($property->getName(), $this->expectedProperties),
                "Property '{$property->getName()}' should not exist"
            );
        }
    }

    /**
     * Teste la visibilité des propriétés de la classe.
     */
    public function testPropertiesVisibility()
    {
        $webPage = new WebPage();
        $reflection = new \ReflectionClass(get_class($webPage));
        // Properties visibility
        foreach ($reflection->getProperties() as $property) {
            $this->assertTrue($property->isPrivate(), "Property '{$property->getName()}' should be private");
        }
    }

    /**
     * Teste le constructeur sans paramètre.
     */
    public function testEmptyConstructor()
    {
        $webPage = new WebPage();

        foreach ($this->expectedProperties as $propertyName) {
            $this->assertEmpty(self::getPropertyValue($webPage, $propertyName), "The property '{$propertyName}' should contain an empty string");
        }
    }

    /**
     * Teste le constructeur avec un paramètre.
     */
    public function testConstructorWithParameter()
    {
        $fakeTitle = 'fakeTitle';
        $webPage = new WebPage($fakeTitle);

        // Test title
        $propertyName = 'title';
        $this->assertEquals($fakeTitle, self::getPropertyValue($webPage, $propertyName), "The property '{$propertyName}' should contain the value of the parameter of the constructor");
        // Test other properties
        $expectedProperties = $this->expectedProperties;
        unset($expectedProperties[array_search('title', $expectedProperties)]);
        foreach ($expectedProperties as $propertyName) {
            $this->assertEmpty(self::getPropertyValue($webPage, $propertyName), "The property '{$propertyName}' should contain an empty string");
        }
    }

    /**
     * Teste la méthode setTitle().
     */
    public function testSetTitle()
    {
        $fakeTitle = 'fakeTitle';
        $webPage = new WebPage();
        $webPage->setTitle($fakeTitle);

        // Test title
        $propertyName = 'title';
        $this->assertEquals($fakeTitle, self::getPropertyValue($webPage, $propertyName), "The property '{$propertyName}' should contain the value of the parameter of the method setTitle()");
    }

    /**
     * Teste la méthode appendContent() appelée une fois.
     */
    public function testAppendContentOnce()
    {
        $fakeBody = 'fakeBody';
        $webPage = new WebPage();
        $webPage->appendContent($fakeBody);

        $propertyName = 'body';
        $this->assertEquals($fakeBody, self::getPropertyValue($webPage, $propertyName), "The property '{$propertyName}' should contain the value of the parameter of appendContent");
    }

    /**
     * Teste la méthode appendContent() appelée deux fois.
     */
    public function testAppendContentTwice()
    {
        $fakeBody1 = 'fakeBody first line';
        $fakeBody2 = 'fakeBody second line';
        $webPage = new WebPage();
        $webPage->appendContent($fakeBody1);
        $webPage->appendContent($fakeBody2);

        $propertyName = 'body';
        $this->assertEquals($fakeBody1 . $fakeBody2, self::getPropertyValue($webPage, $propertyName), "The property '{$propertyName}' should contain the value of the parameter of appendContent");
    }

    /**
     * Teste la méthode escapeString().
     */
    public function testEscapeString()
    {
        $webPage = new WebPage();

        $string = "<>éàôïaz&erty ' \"";
        $escapedString = '&lt;&gt;éàôïaz&amp;erty &apos; &quot;';
        $this->assertEquals($escapedString, $webPage->escapeString($string), "The static method escapeString should use htmlspecialchars() properly");
    }

    /**
     * Teste la méthode getHead().
     */
    public function testGetHead()
    {
        $fakeHead1 = 'fakeHead first line';
        $fakeHead2 = 'fakeHead second line';
        $webPage = new WebPage();
        $webPage->appendToHead($fakeHead1);
        $webPage->appendToHead($fakeHead2);

        $this->assertEquals($fakeHead1 . $fakeHead2, $webPage->getHead(), "The method 'getHead()' should return the content of the property 'head'");
    }

    /**
     * Teste la méthode getBody().
     */
    public function testGetBody()
    {
        $fakeBody1 = 'fakeBody first line';
        $fakeBody2 = 'fakeBody second line';
        $webPage = new WebPage();
        $webPage->appendContent($fakeBody1);
        $webPage->appendContent($fakeBody2);

        $this->assertEquals($fakeBody1 . $fakeBody2, $webPage->getBody(), "The method 'getBody()' should return the content of the property 'body'");
    }
}
