<?php

declare(strict_types=1);

require_once('../autoload.php');

$webpage = new WebPage();

$webpage->setTitle('Ma première page Web objet');

$webpage->appendCssUrl('https://iut-info.univ-reims.fr/users/cutrona/intranet/but/s2/php-webpage/tests/style.css');
$webpage->appendCSS(
    <<<CSS
    #css-inline-test {
      background-color: darkgreen !important;
    }
CSS
);

$webpage->appendJSUrl('https://iut-info.univ-reims.fr/users/cutrona/intranet/but/s2/php-webpage/tests/script.js');
$webpage->appendJS(
    <<<JAVASCRIPT
    window.addEventListener('load', function () {
        document.querySelector('#js-inline-test').style = 'background-color: darkgreen';
    });
JAVASCRIPT
);

$string = $webpage->escapeString('<body>');

$webpage->appendContent(
    <<<HTML
    <main>
        <h1>Ma première page Web en PHP objet !</h1>
        <p>Vous êtes en train de lire votre première page Web écrite en <em>PHP objet</em>.
        <div style="color: white;">
            <div id="js-url-test" style="background-color: darkred;">JavaScript URL</div>
            <div id="js-inline-test" style="background-color: darkred;">JavaScript inline</div>
        </div>
        <div style="color: white;">
            <div id="css-url-test" style="background-color: darkred;">CSS URL</div>
            <div id="css-inline-test" style="background-color: darkred;">CSS inline</div>
        </div>
    </main>
HTML
);

$webpage->appendContent("<p>Vous êtes à la fin de <code>$string</code>.");

echo $webpage->toHTML();
