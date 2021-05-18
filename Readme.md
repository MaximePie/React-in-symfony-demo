Le code a été créé grâce au cours de [La Paresselle](https://www.notion.so/lapasserelle/Le-on-Symfony-React-64e40fb361ce43dc99b0f8af6aa2c10a), 


## Pour lancer le projet rapidement : 

Téléchargez le projet : `git clone https://github.com/MaximePie/formation-react-api.git && cd symfony-reacto`
Installez le projet : `composer install && npm install`
Lancez le projet serveur : `symfony server:start`
Lancez le projet front dans une autre console, sans éteindre le serveur `npm run watch`

## Installation 

Depuis le dossier racine de votre projet 

```bash
composer require symfony/maker-bundle --dev
composer require orm
composer require symfony/webpack-encore-bundle
composer require --dev orm-fixtures
composer require symfony/twig-bundle
npm install
npm uninstall stimulus @symfony/stimulus-bridge
rm -rf assets/controllers assets/controllers.json assets/bootstrap.js
```


Si `rm -rf assets/controllers assets/controllers.json assets/bootstrap.js` ne marche pas,

Supprimer le dossier assets/controllers, puis le fichier assets/controllers.json, puis le fichier assets/bootstrap.js

Ouvrir le fichier `webpack.config.js` et **supprimer** les lignes 25-26 :

```jsx
// enables the Symfony UX Stimulus bridge (used in assets/bootstrap.js)
.enableStimulusBridge('./assets/controllers.json')
```

Un peu plus bas, **retirer le commentaire** ligne 64 :

```jsx
// uncomment if you use React
.enableReactPreset()
```


Installer React 
`npm install @babel/preset-react@^7.0.0 --save-dev`

Puis 
`npm install --dev react react-dom`


#### Note
Assurez-vous d'avoir : 
- Créé votre base de données `php bin/console doctrine:database:create`
- Créé vos migrations `php bin/console make:migrations`
- Migré vos tables `php bin/console doctrine:migrations:migrate`
(Optionnel) - Chargé vos Fixtures : `php bin/console doctrine:fixtures:load`


Ouvrir le fichier `assets/app.js` et remplacer par les lignes suivantes : 

```js
import './styles/app.css';
import React from "react";
import ReactDOM from 'react-dom';
import App from "./js/App";

// start the Stimulus application
// import './bootstrap';

ReactDOM.render(<App/>, document.getElementById('root'));

```

Créer un fichier `js/App.jsx` et ajoutez-y le code suivant : 

```js
import React from "react";

export default function App() {
  return (
    <div>
      <h2>Bonjour le monde.</h2>
    </div>
  )
}
```

Dans un controller, celui de votre choix, créer cette méthode avec la route `/search`

```php
<?php
    /**
     * @Route("/search", name="recherche")
     */
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }
?>
```


Dans `templates/search.html.twig`
```HTML
{# templates/base.html.twig #}
<!DOCTYPE html>
<html>
    <head>
        <!-- ... -->

        {% block stylesheets %}
            {# 'app' must match the first argument to addEntry() in webpack.config.js #}
            {{ encore_entry_link_tags('app') }}

            <!-- Renders a link tag (if your module requires any CSS)
                 <link rel="stylesheet" href="/build/app.css"> -->
        {% endblock %}

        {% block javascripts %}
            {{ encore_entry_script_tags('app') }}

            <!-- Renders app.js & a webpack runtime.js file
                <script src="/build/runtime.js" defer></script>
                <script src="/build/app.js" defer></script>
                See note below about the "defer" attribute -->
        {% endblock %}
    </head>
    <body>
      <div id="root"></div>
    </body>
</html>
```

Lancer l'application BACK avec `symfony server:start`, ou `MAMP, XAMP, etc`
Lancer l'application front avec `npm run watch`

#### Avec PostMan 

Pour faciliter les tests, vous pouvez utiliser l'outil Postman

Créer une nouvelle requête de type POST avec les détails suivants : 
![image](https://user-images.githubusercontent.com/16031936/114188056-00cc8d80-9949-11eb-9f17-be3c9ca2a7d6.png)

Puis remplir le formulaire dans l'onglet Body
![image](https://user-images.githubusercontent.com/16031936/114188120-180b7b00-9949-11eb-9a3c-a79e2bb21667.png)

