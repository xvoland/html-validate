# Assert HTMLValidate for PHPUnit

## What is it?

Assert HTMLValidate this is extension for [PHPUnit][phpunit] based on [Validator.nu][validator.nu].
It includes the `function assertHTMLValidate()` which inspects HTML and expects `true`.


## Preset Schemas (from [validator.nu][validator.nu/presets])
HTML5 (experimental)
* HTML5 (text/html-compatible content models)
* HTML5+ARIA (experimental)
* HTML5 with ARIA (unendorsed integration prototype)

Mike(tm) Smith has generated documentation for this schema.
* HTML 4.01 Strict + IRI / XHTML 1.0 Strict + IRI
* XHTML 1.0 Strict with IRI support. Generally suitable for use HTML 4.01 Strict checking as well, although there are theoretically wrong corner cases. Uses backported HTML5 datatypes.
* HTML 4.01 Transitional + IRI / XHTML 1.0 Transitional + IRI
* XHTML 1.0 Transitional with IRI support. Generally suitable for use HTML 4.01 Transitional checking as well, although there are theoretically wrong corner cases. Uses backported HTML5 datatypes.
* HTML 4.01 Frameset + IRI / XHTML 1.0 Frameset + IRI
* XHTML 1.0 Frameset with IRI support. Generally suitable for use HTML 4.01 Frameset checking as well, although there are theoretically wrong corner cases. Uses backported HTML5 datatypes. Do not use. :-)
* XHTML5 (experimental)
* XHTML5 (XML-compatible content models)
* XHTML5+ARIA, SVG 1.1 plus MathML 2.0 (experimental)
* XHTML5 with ARIA (unendorsed integration prototype), SVG 1.1, MathML 2.0 and holes for OpenMath, RDF and Inkscape cruft.
* XHTML 1.0 Strict, SVG 1.1, MathML 2.0 + IRI
* XHTML 1.0 (not 1.1), SVG 1.1 and MathML 2.0 with IRI support.
* XHTML 1.0 Strict, Ruby, SVG 1.1, MathML 2.0 + IRI
* XHTML 1.0 (not 1.1), Ruby, SVG 1.1 and MathML 2.0 with IRI support.
* XHTML Basic + IRI

A schema for XHTML Basic with IRI support. Suitable for use with the HTML parser.
* SVG 1.1 + IRI
* SVG 1.1 Full with IRI support (Inkscape cruft not permitted).


## Usage

1. You should already have installed [PHPUnit][phpunit]
2. Next, you need to copy the file `assertHTMLValidate.php` to the directory `PHPUnit/`
3. Change the file `PHPUnit/Autoload.php` to load automatically `assertHTMLValidate.php`. (This should be something like `require_once 'assertHTMLValidate.php';`)
4. Now, you can use the assertion in your unittests. `Assert::HTMLValidate(<html_code>, ["text/xhtml/html/xml/json"])`

Here are some examples of how this can be in your unittests:
```Assert::HTMLValidate('<span>Hello world</span>')```

```Assert::HTMLValidate($this->render($someDecorator))```

## License
In the beginning, read [Terms of service][validator.nu/tos] validator.nu.

Assert HTMLValidate is released under the MIT Licence. See the bundled `LICENSE` file for details.

## Author and Sponsorship
We'd be glad to see most of you at our page http://dotoca.net Probably you'll find here something more interesting

[validator.nu]: http://validator.nu
[validator.nu/presets]: http://validator.nu/#presets
[validator.nu/tos]: http://validator.nu/#tos
[phpunit]: https://github.com/sebastianbergmann/phpunit
