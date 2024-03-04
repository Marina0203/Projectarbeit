## Project Setup

Use npm or yarn
```sh
npm install
```

### Compile and Hot-Reload for Development

```sh
npm run dev
```

### Watcher only for Development

```sh
npm run watch
```

### Type-Check, Compile and Minify for Production

```sh
npm run build
```

### Lint with [ESLint](https://eslint.org/)

```sh
npm run lint
```

## General Briefing

### Environment
* Use npm or yarn for package management

### HTML
* HTML must be W3C valid https://validator.w3.org/

### CSS
* Try to minimize custom CSS and instead override the BS5 variables
* Create for each section in the DOM an own SCSS file if it contains custom CSS
* Create a custom CSS class for each section with this naming scheme:
.ce-%ELEMENT_NAME%

### JS
* Don't use jQuery
* Build sections like independent components. That means, every HTML section should have it’s own JavaScript file from the building process, if it requires custom scripts. This makes it possible to include JS files only if needed.
* The main js file should only contain necessary functions for the base layout. That could be for example menu and footer functions which are necessary on each page.
* All Elements should be placeable multiple times on the same page. This means the JavaScript needs working selectors for that case.
* Avoid using IDs for Element Selections

### Fonts
* If we are using any Google Fonts - Please download them into the project https://gwfh.mranftl.com/fonts
