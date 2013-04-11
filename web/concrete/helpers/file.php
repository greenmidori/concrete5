<?

/**
 * File helper
 * 
 * Functions useful for working with files and directories.
 * 
 * Used as follows:
 * <code>
 * $file = Loader::helper('file');
 * $path = 'http://www.concrete5.org/tools/get_latest_version_number';
 * $contents = $file->getContents($path);
 * echo $contents;
 * </code> 
 *
 * @package Helpers
 * @category Concrete
 * @author Andrew Embler <andrew@concrete5.org>
 * @copyright  Copyright (c) 2003-2008 Concrete5. (http://www.concrete5.org)
 * @license    http://www.concrete5.org/license/     MIT License
 */

defined('C5_EXECUTE') or die("Access Denied.");
class FileHelper extends Concrete5_Helper_File {
	
	/** 
	 * Cleans up a filename and returns the cleaned up version
	 * @param string $file
	 * @return string @file
	 */
	public function sanitize($file) {
		// $file = preg_replace("/[^0-9A-Z_a-z-.\s]/","", $file); // pre 5.4.1 allowed spaces
		$pathinfo = pathinfo($file);
		$extension = !empty($pathinfo['extension']) ? '.' . $pathinfo['extension'] : '';
		$file = str_replace($extension, '', $file);
		$file_sanitized = preg_replace(array("/[\s]/","/[^0-9A-Z_a-z-.]/"),array("_",""), $file);
		$file = (strlen($file_sanitized) > 0) ? $file_sanitized . $extension : md5($file) . $extension;
		return trim($file);
	}

}