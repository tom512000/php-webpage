<?php

declare(strict_types=1);

class WebPage
{
    private string $head = "";
    private string $title = "";
    private string $body = "";

    /**
     * Constructeur de la classe WebPage. Ce constructeur permet d’affecter un titre à une WebPage.
     * Lorsque ces caractéritiques ne sont pas renseignées lors de l’appel du contructeur,
     * titre prend la valeur "".
     *
     * @param string $title (optional) Titre de la page Web
     */
    public function __construct(string $title = "")
    {
        $this->title = $title;
    }

    /**
     * Accesseur de la classe Webpage. Retourne la valeur de head sous forme de chaîne
     * de caractères.
     *
     * @return string
     */
    public function getHead(): string
    {
        return $this->head;
    }

    /**
     * Accesseur de la classe Webpage. Retourne la valeur de title sous forme de chaîne
     * de caractères.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Modificateur du titre de la classe Webpage.
     *
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Accesseur de la classe Webpage. Retourne la valeur de body sous forme de chaîne
     * de caractères.
     *
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Méthode permettant d'ajouter du contenu dans la balise <head>
     * 
     * @param string $content
     */
    public function appendToHead(string $content) : void
    {
        $this->head .= $content;
    }

    /**
     * Méthode permettant d'ajouter du css dans la balise <head>
     * 
     * @param string $css
     */
    public function appendCss(string $css) : void
    {
        $this->head .= "<style>{$css}</style>";
    }

    /**
     * Méthode permettant d'ajouter un lien css dans la balise <head>
     * 
     * @param string $url
     */
    public function appendCssUrl(string $url) : void
    {
        $this->head .= "<link href={$url} rel='stylesheet'>";
    }

    /**
     * Méthode permettant d'ajouter du javascript dans la balise <head>
     * 
     * @param string $js
     */
    public function appendJs(string $js) : void
    {
        $this->head .= "<script>{$js}</script>";
    }

    /**
     * Méthode permettant d'ajouter un lien javascript dans la balise <head>
     * 
     * @param string $url
     */
    public function appendJsUrl(string $url): void
    {
        $this->head .= "<script type='text/javascript' src={$url}></script>";
    }

    /**
     * Méthode permettant d'ajouter du contenu dans la balise <body>
     * 
     * @param string $content
     */
    public function appendContent(string $content) : void
    {
        $this->body .= $content;
    }

    /**
     * Méthode permettant de retourner le code HTML du site
     */
    public function toHTML() : string
    {
        $html = <<<HTML
        <!DOCTYPE html>
        <html lang="fr">
            <head>
                <title>$this->title</title>
                $this->head
            </head>
            <body>
                 $this->body
                 <div style='font-style: italic; text-align: right;'>
                    {$this->getLastModification()}
                </div>
            </body>
        </html>
        HTML;
        return $html;
    }

    /**
     * Méthode permettant de vérifier les caractères spéciaux du contenu de $string
     * 
     * @param string $string
     */
    public function escapeString(string $string) : string
    {
        return htmlspecialchars($string, ENT_QUOTES | ENT_HTML5);
    }

    /**
     * Méthode permettant de retourner la date et l'heure de la dernière modification du code HTML
     */
    public function getLastModification() : string
    {
        return "Dernière modification de cette page le ".date("d/m/Y à H:i:s", getlastmod());
    }
}