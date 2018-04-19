<?php
/**
 * Disallows inline variable assignment (i.e. in an if statement).
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

namespace Barracuda\Sniffs\ControlStructures;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

/**
 * Disallows inline variable assignment.
 */
class NoInlineAssignmentSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
		return array(
			T_IF,
			T_ELSEIF,
		);

	} // end register()


    /**
     * Processes this sniff, when one of its tokens is encountered.
     *
     * @param File $phpcsFile The file being scanned.
     * @param int  $stackPtr  The position of the current token in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

		$end_position = $tokens[$stackPtr]['parenthesis_closer'];

		// states: -1 = normal, 0 = start function call (probably), 1 = in function
		$function = -1;

		for ($position = $stackPtr; $position < $end_position; $position++)
		{
			if ($tokens[$position]['type'] == 'T_STRING')
			{
				$function = 0;
				continue;
			}

			if ($function === 0)
			{
				if ($tokens[$position]['type'] == 'T_OPEN_PARENTHESIS')
				{
					$function = 1;
					continue;
				}
			}
			elseif ($function !== 1)
			{
				$function = -1;
				if ($tokens[$position]['type'] == 'T_EQUAL')
				{
					$error = 'Inline assignment not allowed in if statements';
					$phpcsFile->addError($error, $stackPtr, 'IncDecLeft');
					return;
				}
			}
		}
    }
}
