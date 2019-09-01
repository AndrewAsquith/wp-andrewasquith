# wp-andrewasquith

The WordPress theme in use on [AndrewAsquith.com](https://www.andrewasquith.com).


## Setup

Clone the repository and run npm install to install gulp and dependencies
> npm install

Setup .env - see [.env.sample](.env.sample) for an example. set WORDPRESS_ENV to production or development depending on need.

If you're going to deploy to docker for development, you need a wordpress docker image with the basic installation completed. Configure wpContainerName in _gulp/config.json to match the name of your container. 


## Development

CSS is built with SASS.

The build process uses [Gulp](https://gulpjs.com). 

To build the theme
> gulp build

To prepare the theme for distribution as a zip file
> gulp dist

To install the theme in your docker container and activate it
> gulp docker:dev


## Features

The theme 
* is translation ready
* supports a custom header (randomly rotating) or a featured image as a header on a per post basis
* Contains Bootstrap4, Font Awesome Free, Popper.js and Animate.css (updateable via NPM)
* contains simple bootstrap row and col blocks
* contains two generic layout container blocks for div and section


### Credits 

* Based on Underscores https://underscores.me/, (C) 2012-2017 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* Bootstrap4 https://getbootstrap.com/, Copyright (C) 2011-2019 Twitter, Inc., Copyright (C) 2011-2019 The Bootstrap Authors, [MIT](https://opensource.org/licenses/MIT)
* Popper.js https://popper.js.org/, Copyright (C) 2016 Federico Zivolo and contributors, [MIT](https://opensource.org/licenses/MIT)
* Font Awesome Free https://fontawesome.com/, Copyright (C) Fonticons, Inc. [Font Awesome Free License](https://github.com/FortAwesome/Font-Awesome/blob/master/LICENSE.txt)
* Animate.css https://daneden.github.io/animate.css/, Copyright (C) 2019 Daniel Eden, [MIT](https://opensource.org/licenses/MIT)
* normalize.css https://necolas.github.io/normalize.css/, (C) 2012-2016 Nicolas Gallagher and Jonathan Neal, [MIT](https://opensource.org/licenses/MIT)