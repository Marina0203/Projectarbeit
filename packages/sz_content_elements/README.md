# SUNZINET Content Elements

This extension allows you to create your own content elements as easily as possible.

All the files needed for a content element go into just two folders. One for the configuration files and one for the icon.

**Please delete the .gitkeep files as soon as you create a content element!**

By default, the following files are supported and will be loaded automatically:
- FlexForm.xml
- Page.tsconfig
- Setup.typoscript
- Tca.php
- Database.sql
- Icon.svg

The latter belongs in the public folder.

Example structure of the Slider content element:

Resources/Private/ContentElements/Slider<br>
../Frontend/Templates/Slider.html<br>
../Language<br>
..../locallang.xlf<br>
..../locallang_be.xlf<br>
..../locallang_ff.xlf<br>
../FlexForm.xml<br>
../Page.tsconfig<br>
../Setup.typoscript<br>
../Tca.php<br>
../Database.sql<br>

Resources/Public/ContentElements/Slider<br>
../Icon.svg<br>

## How it works

### Database.sql

An event listener is used to pass the contents of the SQL files to the core.

> \SUNZINET\SzContentElements\Listener\Core\RegisterContentElementSqlDefinitions

### Tca.php & FlexForm.xml

Both files of all content elements are included, respectively added in
TCA/Overrides/tt_content.php.

> /Configuration/TCA/Overrides/tt_content.php

### Icon.svg

Icons are automatically registered in Icons.php. The identifier is derived from
the name of the content element: \<lowercasenameofce\>-icon. For our slider
element, it would then automatically be "slider-icon" and for
DoomSlayerHunterOverkillSlider it would be "doomslayerhunteroverkillslider-icon".

> /Configuration/Icons.php

### Setup.typoscript & Page.tsconfig

These are also loaded automatically. Which ensures that the content elements are
available in all page trees without any further action. If a content element is
not available in a page tree, you can hide it via PageTS:
`TCEFORM.tt_content.CType.removeItems := addToList(nameofce)`.

> /ext_localconf.php
