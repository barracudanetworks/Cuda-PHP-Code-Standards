Barracuda PHP Code Standards
============================

The Barracuda coding standards follow PSR-1 and PSR-2 standards closely with a few specific exceptions and additions.  These exceptions and additions have been agreed upon by a working group of leaders within each of the teams that use PHP.

INSTALLATION
------------

1. Install [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer#installation)

2. Install your editor plugin.
 - For Sublime Text, this is `Phpcs` in Package Control.
 - For Atom, install `linter` and `linter-phpcs`

SETUP
-----

When running `phpcs` or `phpcbf` point it to the location where you cloned this repo with the `--standard=/path/to/this/repo/PHP_CodeSniffer/Barracuda/ruleset.xml`

Below are some sample configurations for various editors:

### Sublime Text 2 & 3
There is an example .sublime-project file for Sublime Text in the config directory. You'll need to rename it to .sublime-project and place it in your repo directories.

	{
		"phpcs_additional_args": {

		 	// self-explanatory
			"--standard": "/absolute/path/to/commonstandards/Barracuda/ruleset.xml",

			// this allows us to continue to use tabs (part of our standard)
			"--tab-width": "4",

			// this silences notices and yells only about important stuff
			"-n": ""
		},

		// self-explanatory
		"phpcs_executable_path": "/absolute/path/to/phpcs"
	}

### Atom
For Atom, the following configuration should be added to ~/.atom/Config.cson. It can also be configured in the `linter-phpcs` settings page.

	"linter-phpcs":
	    codeStandardOrConfigFile: "/absolute/path/to/commonstandards/Barracuda/ruleset.xml"
	    executablePath: "/absolute/path/to/phpcs"
	    tabWidth: 4
	    warningSeverity: 0

### vim
It is suggested to use [Syntastic](https://github.com/scrooloose/syntastic) for vim.
This supports phpcs for php checking as well as many other languages
The following config should do php linting as well as code sniffing

	" Use the following for checking php files
	let g:syntastic_php_checkers = ['php', 'phpcs']
	" Aggregate all the errors together
	let g:syntastic_aggregate_errors = 1
	" Set phpcs args
	let g:syntastic_php_phpcs_args="--standard=/path/to/common-standards/Barracuda"

### PhpStorm
To get set up just follow the instructions at (https://confluence.jetbrains.com/display/PhpStorm/PHP+Code+Sniffer+in+PhpStorm)

In summary the steps are:
- In the PhpStorm settings, search for "Code Sniffer" or find it at Languages & Frameworks > PHP > Code Sniffer
- Under Configuration make sure "Local" is selected and click the menu button
- Set your code sniffer phpcs path to the location where you install the code sniffer files above
- Click the "Verify" button to make sure code sniffer is working
- In settings, search for "Inspections" or find it under Editor > Inspections
- Within Inspections look for the "PHP Code Sniffer Validation" option. Enable it.
- You should see an option named "Coding standard." Select "Custom" and then use the menu button to input the directory you install the Barracuda standards repo to.

You should now be able to run code sniffer by going to Code > Inspect Code in the PhpStorm menu!

TODO
----
- require newline or opening brace before // comments
- require $underscored_variable_names
- require no brace-contained else clauses in inline IFs
- disallow "naked $vars in text" (require braces)
- require spaces around concatenation operator

DONE
----
- require dropped braces
- allow tabs for indentation (via command-line option)
- disallow inline IFs again
- require // comments only on own line
- disallow space after ! in conditions
- require space as first char of // comment
- disallow assignment in if/elseif statements
