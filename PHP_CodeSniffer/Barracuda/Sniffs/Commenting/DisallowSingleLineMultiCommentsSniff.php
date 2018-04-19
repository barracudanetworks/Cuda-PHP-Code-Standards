<?php
/**
 * This sniff prohibits the use of single line block comments
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Ryan Matthews <rmatthews@barracuda.com>
 * @license   BSD License 2.0, see LICENSE file.
 * @version   2.0.00
 * @link      https://github.com/BarracudaNetworks/Cuda-PHP-Code-Standards/
 */

 namespace Barracuda\Sniffs\Commenting;

 use PHP_CodeSniffer\Sniffs\Sniff;
 use PHP_CodeSniffer\Files\File;

/**
 * Prohibits single line block comments.
 */
class DisallowSingleLineMultiCommentsSniff implements Sniff
{


    /**
     * Returns the token types that this sniff is interested in.
     *
     * @return array(int)
     */
    public function register()
    {
        return array(T_COMMENT);

    }// end register()


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
		if (preg_match('/\/\*[^\n]*\*\//', $tokens[$stackPtr]['content']))
		{
            $error = 'Multi line comments are prohibited on single lines; found %s';
            $data  = array(trim($tokens[$stackPtr]['content']));
            $phpcsFile->addError($error, $stackPtr, 'Found', $data);
        }

    }// end process()
}
// end class
