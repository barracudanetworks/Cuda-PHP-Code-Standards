<?php
/**
 * This sniff requires a space after the opening of a comment (e.g. "// Foo", "/* Foo")
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Andy Blyler <ablyler@barracuda.com>
 * @license   BSD License 2.0, see LICENSE file.
 * @version   2.0.00
 * @link      https://github.com/BarracudaNetworks/Cuda-PHP-Code-Standards/
 */

namespace Barracuda\Sniffs\Commenting;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

/**
 * Requires a space after opening of comment.
 */
class SpaceAfterCommentSniff implements Sniff
{
    /**
     * Returns the token types that this sniff is interested in.
     *
     * @return array(int)
     */
    public function register()
    {
        return array(T_COMMENT);

    } // end register()


    /**
     * Processes the tokens that this sniff is interested in.
     *
     * @param File $phpcsFile The file where the token was found.
     * @param int  $stackPtr  The position in the stack where the token was found.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

		$valid = false;

		if (preg_match('|//\s|', $tokens[$stackPtr]['content']))
		{
			$valid = true;
		}

		if (preg_match('|\*[\s/]|', $tokens[$stackPtr]['content']))
		{
			$valid = true;
		}

		if ($valid === false)
		{
            $error = 'A space is required at the start of the comment %s';
            $data  = array(trim($tokens[$stackPtr]['content']));
            $phpcsFile->addError($error, $stackPtr, 'Found', $data);
        }

    }// end process()
}
// end class
